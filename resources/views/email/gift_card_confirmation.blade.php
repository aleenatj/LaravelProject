<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Card</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; margin: 0; padding: 0; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border: 2px solid #E04609;">
        <div style="background-color: #E04609; color: #fff; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
            <h1 style="margin: 0;">You have received a gift card!</h1>
        </div>
        <img src="https://img.ehowcdn.com/-/cme-data/getty/5567433cef5e4e06a8776ca35ec67b6c.jpg" alt="Gift Card" style="width: 100%; height: auto; margin-top: 10px; border-radius: 8px;">
        <div style="padding: 20px;">
            <p style="font-size: 18px; margin: 10px 0;"><strong></strong> {{ $orderCard->from }}</p>
            <p style="font-size: 15px; margin: 10px 0;"><strong></strong> {{ $orderCard->description }}</p>
            <p style="font-size: 18px; margin: 10px 0;"><strong>Amount:</strong> ${{ $orderCard->amount }}</p>
            <p style="font-size: 18px; margin: 10px 0;"><strong>Code:</strong> {{ $orderCard->code }}</p>
            
            <p style="font-size: 18px; margin: 10px 0;"><strong>Expiry Date:</strong> {{ $orderCard->expiry_date }}</p>
            <a href="{{ url('/') }}" style="display: inline-block; padding: 10px 20px; margin-top: 20px; font-size: 18px; color: #fff; background-color: black; border-radius: 5px; text-decoration: none;">Redeem Now</a>
        </div>
        <div style="text-align: center; padding: 20px; font-size: 14px; color: #777;">
            <p>Thank you for choosing our service!</p>
        </div>
    </div>
</body>
</html>
