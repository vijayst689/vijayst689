<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>

body{
font-family: DejaVu Sans;
margin:0;
padding:0;
}

.card{
width:350px;
height:220px;
border:2px solid #333;
border-radius:12px;
overflow:hidden;
}

/* HEADER */

.header{
background:#4f46e5;
color:#fff;
padding:8px;
text-align:center;
font-size:14px;
font-weight:bold;
}

/* CONTENT */

.content{
padding:10px;
}

.left{
width:65%;
float:left;
}

.right{
width:35%;
float:right;
text-align:center;
}

/* PHOTO */

.photo img{
width:70px;
height:80px;
border:1px solid #999;
margin-bottom:5px;
}

/* QR */

.qr img{
width:70px;
}

/* TEXT */

.label{
font-size:9px;
color:#777;
}

.value{
font-size:12px;
font-weight:bold;
margin-bottom:4px;
}

/* FOOTER */

.footer{
background:#eee;
font-size:9px;
text-align:center;
padding:3px;
clear:both;
}

</style>
</head>

<body>

<div class="card">

<div class="header">
{{ $user->title }}
</div>

<div class="content">

<div class="left">

@if($user->meetingphoto)
<div class="photo">
<img src="{{ public_path('storage/'.$user->meetingphoto) }}">
</div>
@endif

<div class="label">Name</div>
<div class="value">{{ $user->name }}</div>

<div class="label">Mobile</div>
<div class="value">{{ $user->mobile }}</div>

<div class="label">Date</div>
<div class="value">
{{ \Carbon\Carbon::parse($user->meetingdate)->format('d M Y') }}
</div>

</div>

<div class="right">

<div class="qr">
<img src="{{ public_path('qr/'.$user->id.'.png') }}">
</div>

<div style="font-size:10px;margin-top:5px;">
ENTRY PASS
</div>

</div>

</div>

<div class="footer">
Valid for one participant • {{ $user->place }}
</div>

</div>

</body>
</html>