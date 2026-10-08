<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Facades\Image;
use Normalizer;

class MeetingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function meetinglist(){
    $data = DB::table( 'meetinglist' )->orderBy( 'id', 'Desc' )->get();
    return view( 'meeting.meetinglist',compact('data'));
  }


  public function savemeeting( Request $request ) {
    DB::table( 'meetinglist' )->insert( [
      'title'       => $request->title,
      'meetingdate'       => $request->meetingdate,
      'place'       => $request->place,
      'amount'       => $request->amount,
      'status'     => 'Inactive',
    ] );

    return redirect('/meetinglist')->with('success', 'Meeting Added Successfully ... !');
  }

  public function updatemeeting( Request $request ) {
    if ($request->file('meeting_banner')) {
    $meeting_banner = $request->file('meeting_banner')->store('meeting_banner','public');
}
    DB::table( 'meetinglist' )->where('id', $request->meetingid)->update( [
      'title'     => $request->title,
      'meetingdate'     => $request->meetingdate,
      'place'     => $request->place,
      'amount'     => $request->amount,
      'status'     => $request->status,
      'meetingbanner' => $meeting_banner,
    ] );


    return redirect()->back()->with( 'success', 'Meeting Updated Successfully' );
  }

  public function deletemeeting( $id ) {
    DB::table( 'meetinglist' )->where( 'id', $id )->delete();
    return redirect()->back()->with( 'success', 'Meeting Deleted Successfully' );
  }

  public function meetingregister($id)
  {
    $isRegistered = DB::table('meetingdetails')
    ->where('meetingid', $id)
    ->where('user_id', Auth::id())
    ->first();
    $meeting = DB::table('meetinglist')->where('id', $id)->first();
    return view('meeting.register', compact('meeting', 'isRegistered','id'));
  }

  
      public function create(Request $request)
{
    $meetingid = $request->meeting_id;
    $userId    = auth()->id();

    // ---------------- MEETING ----------------
    $meeting = DB::table('meetinglist')->where('id', $meetingid)->first();
    if (!$meeting) {
        return back()->with('error', 'Invalid Meeting');
    }

    $amount = $meeting->amount;

    // ---------------- VALIDATION ----------------
    $request->validate([
        'amount' => 'required|numeric|min:' . $amount,
        'name'   => 'required|string|max:100',
        'mobile' => 'required|digits:10',
        'photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        'amount.min' => 'Minimum meeting amount is ₹' . $amount,
    ]);

    // ---------------- NALAVARIYAM STATUS ----------------
    $user = DB::table('users')->where('id', $userId)->first();
    $text = ($user && $user->verified == 1) ? 'Activated' : 'Not Activated';

    // ---------------- PHOTO UPLOAD ----------------
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')
            ->store('meeting_photos', 'public');
    }

    // ---------------- CHECK EXISTING REGISTRATION ----------------
   $existing = DB::table('meetingdetails')
    ->where('meetingid', $meetingid)
    ->where('user_id', $userId)
    ->first();

if ($existing) {

    DB::table('meetingdetails')
        ->where('id', $existing->id)
        ->update([
            'name'                => $request->name,
            'mobile'              => $request->mobile,
            'meeting_place'              => $request->meeting_place,
            'meeting_address'              => $request->meeting_address,
            'amount'              => $amount,
            'nalavariyamverified' => $text,
            'photo'               => $photoPath ?? $existing->photo,
            'paymentstatus'       => 'Pending',
            'updated_at'          => now(),
        ]);

} else {

    // ✅ INSERT AND GET ID
    $meetingDetailId = DB::table('meetingdetails')->insertGetId([
        'meetingid'            => $meetingid,
        'user_id'              => $userId,
        'amount'               => $amount,
        'name'                 => $request->name,
        'mobile'               => $request->mobile,
        'meeting_place'               => $request->meeting_place,
        'meeting_address'               => $request->meeting_address,
        'username'             => Auth::user()->username,
        'nalavariyamverified'  => $text,
        'photo'                => $photoPath,
        'paymentstatus'        => 'Pending',
        'created_at'           => now(),
    ]);
}


    // ---------------- PAYMENT ORDER ----------------
    $orderId = 'ORD' . time() . rand(1000, 9999);

    DB::table('meetingpayment')->insert([
        'order_id'  => $orderId,
        'user_id'   => $userId,
        'meeting_id' => $meetingid,
        'amount'    => $amount,
        'status'    => 'PENDING',
        'req_date'  => date('Y-m-d'),
        'req_time'  => date('H:i:s'),
    ]);

    // ---------------- GATEWAY ----------------
    $returnUrl = route('meeting.return', ['order_id' => $orderId]);

    $payload = [
        'customer_mobile' => $request->mobile,
        'user_token'      => config('services.ditasol.token'),
        'amount'          => $amount,
        'order_id'        => $orderId,
        'redirect_url'    => $returnUrl,
        'remark1'         => 'Meeting Fee',
        'remark2'         => $userId,
    ];

    $response = Http::asForm()->post(
        'https://api.ditacore.com/api/create-order',
        $payload
    );

    $data = $response->json();
    Log::info('Ditasol Create Order', $data);

    // ---------------- SUCCESS ----------------
    if ($response->successful() && isset($data['result']['payment_url'])) {
        session(['payment_order_id' => $orderId]);
        return redirect($data['result']['payment_url']);
    }

    // ---------------- FAILURE ----------------
    DB::table('meetingpayment')
        ->where('order_id', $orderId)
        ->update([
            'status'     => 'FAILED',
            'updated_at' => now(),
        ]);

    return back()->with('error', 'Unable to initiate payment');
}


    /**
     * STEP 2: Return URL → Verify Payment
     */
  public function return(Request $request, $order_id)
{
    Log::info('Payment return hit', [
        'order_id' => $order_id,
        'query'    => $request->query()
    ]);

    DB::beginTransaction();

    try {
        // 🔒 LOCK ORDER ROW (CRITICAL)
        $order = DB::table('meetingpayment')
            ->where('order_id', $order_id)
            ->lockForUpdate()
            ->first();

        if (!$order) {
            DB::rollBack();
            Log::error('Order not found', ['order_id' => $order]);
            abort(404, 'Invalid Order');
        }

        // 🔒 STOP if already processed
        if ($order->status === 'SUCCESS') {
            DB::commit();
            Log::info('Order already SUCCESS', ['order_id' => $order_id]);
            return redirect()->route('meeting.success', $order_id);
        }

        // 🔹 CALL DITASOL STATUS API (SOURCE OF TRUTH)
        $response = Http::asForm()->post(
            'https://api.ditacore.com/api/check-order-status',
            [
                'user_token' => config('services.ditasol.token'),
                'order_id'   => $order_id
            ]
        );

        if (!$response->successful()) {
            DB::rollBack();
            Log::error('Gateway API failed', ['order_id' => $order_id]);
            return redirect()->route('meeting.failed', $order_id);
        }

        $data = $response->json();
        Log::info('Ditasol status response', $data);

        /**
         * 🔒 NORMALIZE STATUS (VERY IMPORTANT)
         * Gateway may return SUCCESS / COMPLETED
         */
        $rawStatus = strtoupper($data['result']['status'] ?? '');
        $txnStatus = in_array($rawStatus, ['SUCCESS', 'COMPLETED'])
            ? 'SUCCESS'
            : 'FAILED';

        $txnAmount = (float) ($data['result']['amount'] ?? $order->amount);
        $txnUtr    = $data['result']['utr'] ?? null;

        // 🔹 UPDATE ORDER TABLE
        DB::table('meetingpayment')
            ->where('order_id', $order_id)
            ->update([
                'status'          => $txnStatus, // ONLY SUCCESS / FAILED
                'transaction_id' => $txnUtr,
                'updated_at'     => now()
            ]);

        // 🔹 CREDIT WALLET ONLY ON SUCCESS
        if ($txnStatus === 'SUCCESS') {

          
            DB::table('meetingdetails')->where('meetingid', $order->meeting_id)->where('user_id', $order->user_id)->update( [
                'paymentstatus' => 'SUCCESS',
                'updated_at'    => now(),
            ]);
        }

        DB::commit();

        return $txnStatus === 'SUCCESS'
            ? redirect()->route('meeting.success', $order_id)
            : redirect()->route('meeting.failed', $order_id);

    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('Payment return exception', [
            'order_id' => $order_id,
            'error'    => $e->getMessage()
        ]);
        return redirect()->route('meeting.failed', $order_id);
    }
}


public function viewPass($meetingId)
{
    $getdata = DB::table('meetingdetails')
        ->where('user_id', $meetingId)
        ->first();
       
    $user = DB::table('meetingdetails')
        ->join('meetinglist','meetinglist.id','=','meetingdetails.meetingid')
        ->where('meetingdetails.meetingid',$meetingId)
        ->where('meetingdetails.user_id',Auth::id())
        ->select(
            'meetingdetails.id',
            'meetingdetails.name',
            'meetingdetails.mobile',
            'meetingdetails.meeting_place',
            'meetingdetails.meeting_address',
            'meetingdetails.meeting_date',
            'meetingdetails.photo',
            'meetinglist.title',
            'meetinglist.meetingdate',
            'meetinglist.place'
        )
        ->first();



   $font = resource_path('fonts/DejaVuSans.ttf');
    $titleFont = resource_path('fonts/NotoSansTamil-Bold.ttf');
$nameFont = resource_path('fonts/Poppins-Bold.ttf');
$detailFont = resource_path('fonts/NotoSansTamil-Regular.ttf');

    /* BACKGROUND */
    $img = Image::make(public_path('sample.png'))->resize(1000,550);

    /* PHOTO PATH */
    $photoPath = public_path('storage/'.$user->photo);
    if(!file_exists($photoPath)){
        $photoPath = public_path('default-user.png');
    }

    /* PHOTO FIT PERFECTLY */
    $photo = Image::make($photoPath)->fit(215,215);

    /* PHOTO FRAME BACKGROUND */
    // $img->rectangle(110,160,320,370,function($draw){
    //     $draw->background('#ffffff');
    // });

    /* INSERT PHOTO */
    $img->insert($photo,'top-left',90,165);


    /* TITLE */
   $title = explode('(', $user->title);

// $title1 = $title[0];
// $title2 = isset($title[1]) ? '('.$title[1] : '';
$title1 = "Meeting Pass";
$title2 = "";

  $img->text($title1,500,90,function($f) use ($titleFont){
    $f->file($titleFont);
    $f->size(26);
    $f->color('#FFCC00');
    $f->align('center');
});

$img->text($title2,500,115,function($f) use ($titleFont){
    $f->file($titleFont);
    $f->size(20);
    $f->color('#ffffff');
    $f->align('center');
});
$img->line(150,130,850,130,function($draw){
    $draw->color('#1aa0c9');
});
   /* NAME */

$img->text(strtoupper($user->name),350,200,function($f) use ($nameFont){
    $f->file($nameFont);
    $f->size(38);
    $f->color('#000000'); // Cyan
});


/* MOBILE */

$img->text("Mobile : ".$user->mobile,350,250,function($f) use ($detailFont){
    $f->file($detailFont);
    $f->size(26);
    $f->color('#FFFFFF');
});


/* DATE */

$img->text("Date : ".date('d M Y',strtotime($user->meeting_date)),350,300,function($f) use ($detailFont){
    $f->file($detailFont);
    $f->size(26);
    $f->color('#00FF9C'); // Light green
});


/* PLACE */
$place =  $user->meeting_address;

// Wrap text every 25 characters (adjust as needed)
$placeWrapped = wordwrap($place, 35, "\n", true);
$img->text("Place : ".$placeWrapped,350,350,function($f) use ($detailFont){
    $f->file($detailFont);
    $f->size(26);
    $f->color('#FFA726'); // Orange
});

    /* PASS ID */
    $passId = str_pad($user->id, 4, '0', STR_PAD_LEFT);
    $img->text("PASS ID : ".$passId,120,465,function($f) use ($titleFont){
          $f->file($titleFont);
        $f->size(24);
        $f->color('#baf80e');
    });

    return $img->response('png');
}

public function meetingUsers($id)
{
    $users = DB::table('meetingdetails')
        ->where('meetingid', $id)
        ->select(
            'user_id',
            'id',
            'name',
            'username',
            'mobile',
            'meeting_place',
            'meeting_address',
            'amount',
            'paymentstatus',
            'photo',
            'created_at'
        )
        ->get();

    return response()->json([
        'users' => $users,
        'count' => $users->count(),
        'paid_amount' => $users->where('paymentstatus', 'SUCCESS')->sum('amount'),
        'unpaid_amount' => $users->where('paymentstatus', '!=', 'SUCCESS')->sum('amount'),
    ]);
}

public function updateAttendance(Request $request)
{
    $meetingid = $request->meetingid;

    $user = DB::table('meetingdetails')
        ->where('id', $meetingid)
        ->first();

    if(!$user){
        return response()->json([
            'status' => false,
            'message' => 'User not found'
        ]);
    }

    $newStatus = ($user->attendance_status == 'IN') ? 'OUT' : 'IN';

    DB::table('meetingdetails')
        ->where('id', $meetingid)
        ->update([
            'attendance_status' => $newStatus,
            'updated_at' => now()
        ]);

    return response()->json([
        'status' => true,
        'attendance' => $newStatus
    ]);
}
public function updateDetails(Request $request)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'mobile'         => 'required|digits_between:10,12',
        'photo'          => 'nullable|image|max:2048',
        
    ]);

    $existing = DB::table('meetingdetails')
        ->where('id', $request->meeting_id)
        ->where('user_id', auth()->id())
        ->first();

    if (!$existing) {
        return back()->with('error','Registration not found');
    }

    // ---------------- FILES ----------------

    $photoPath = $existing->photo;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')
            ->store('meeting_photos','public');
    }


    // ---------------- UPDATE ----------------
  $meeting_address = ($request->meeting_place == "Thanjavur")
    ? "Shri Besant Lodge, Opp. Jupiter Theatre, Anna Salai, Near old bus stand, Thanjavur"
    : "25-2-104A, Kendaiyur Road, Kattoor, Mettupalayam - 641305, Near Kattoor Pallivasal";

     $meeting_date = ($request->meeting_place == "Thanjavur")
    ? date('Y-m-d', strtotime('2026-05-09'))
    : date('Y-m-d', strtotime('2026-05-10'));

    DB::table('meetingdetails')
        ->where('id', $request->meeting_id)
        ->update([

            'name'          => $request->name,
            'mobile'        => $request->mobile,
            'meeting_place'        => $request->meeting_place,
            'meeting_address'        => $meeting_address,
            'meeting_date'        => $meeting_date,

            'photo'         => $photoPath,

            'updated_at'    => now(),
        ]);

    return back()->with('success','Details updated successfully');
}

 private function getOrder($order_id)
    {
        $order = DB::table('meetingpayment')
            ->where('order_id', $order_id)
            ->first();

        if (!$order) {
            abort(404, 'Order not found');
        }

        return $order;
    }

    public function success($order_id)
    {
        $order = $this->getOrder($order_id);
        return view('meeting.success', compact('order'));
    }

    public function failed($order_id)
    {
        $order = $this->getOrder($order_id);
        return view('meeting.failed', compact('order'));
    }

   public function viewmeetinglist()
{
    $users = DB::table('meetingdetails')
        ->select(
            'user_id',
            'id',
            'name',
            'mobile',
            'amount',
            'paymentstatus',
            'photo',
            'created_at'
        )
        ->get();

    $count = $users->count();
    $paid_amount = $users->where('paymentstatus', 'SUCCESS')->sum('amount');
    $unpaid_amount = $users->where('paymentstatus', '!=', 'SUCCESS')->sum('amount');

    return view('meeting.list', compact('users', 'count', 'paid_amount', 'unpaid_amount'));
}


}
