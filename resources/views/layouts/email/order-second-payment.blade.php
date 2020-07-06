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
<p>We hereby send a confirmation of your second payment to <strong>#{{$order->product->event_id}}</strong>.
    The final price was <strong>{{$order->product->current_price}}dk</strong> and you have therefore saved
    <strong>{{$order->product->savingPercentage()}}%</strong> on
    the starting price.
    Together with your participants you have made it cheaper!
    We will very soon send an email about the expected time for delivery of your product.
    <br><br>
    (Receipt)
    <br><br>
    Thank you for helping to make it cheaper!
</p>
</body>
</html>
