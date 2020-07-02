<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Successful!</title>
</head>
<body>
<br>

<h2>Hello {{$order->user->name}}</h2>
<p>
    We are writing to you again, to remind you of the 2nd payment for <strong> #{{$order->product->event_id}}</strong>.
    The payment deadline expires {{\Carbon\Carbon::parse($order->product->expire_date)->format('d F Y H:s:i')}}. Your
    participation is still valid until the deadline. Don't miss your participation in the event.
    <br><br><br>
    Yours sincerely
    JoinOffers.dk
</p>
</body>
</html>
