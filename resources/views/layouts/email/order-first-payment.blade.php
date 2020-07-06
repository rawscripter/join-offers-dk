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
<p>We hereby send a confirmation of your first deposit to <strong>#{{$order->product->event_id}}</strong>. This participation price is
    a security for you and
    the participant so that JoinOffers can order the products home for you. When the event
    ends <strong>{{\Carbon\Carbon::parse($order->product->expire_date)->format('d F Y H:s:i')}}</strong>, you will
    receive a 2nd payment email.
    <br><br>
    Remember that you can always keep track of the number of participants and your percentage savings by having more
    participants in the event. The "current price" will decrease as more participants participate, and thus the final
    price will fall. At the 2nd payment, JoinOffers will deduct the participation price, so you only have to pay the
    balance.
    <br><br><br>
    (Receipt)<br><br>
    Thank you for helping to make it cheaper!
</p>
</body>
</html>
