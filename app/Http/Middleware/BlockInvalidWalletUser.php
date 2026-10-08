<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlockInvalidWalletUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Skip admin/system users
        if (in_array($user->id, [1, 2])) {
            return $next($request);
        }

        // If already inactive → block
        if ($user->status === 'Inactive') {
            Auth::logout();
            return response()->view('errors.no_permission', [], 403);
        }

        // Extra safety check
        if ($user->wallet > 0) {
            $hasRequested = DB::table('request_payment')
                ->where('from_id', $user->id)
                ->exists();

            if (!$hasRequested) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'status' => 'Inactive',
                    ]);

                Auth::logout();
                return response()->view('errors.no_permission', [], 403);
            }
        }

        return $next($request);
    }
}
