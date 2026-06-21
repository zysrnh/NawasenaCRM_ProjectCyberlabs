<!DOCTYPE html>
<html>
<head>
    <title>Informasi Nawasena</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('img/logo-transparent-color.png') }}" alt="Nawasena" style="height: 50px;">
        </div>
        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
            {!! nl2br(e($messageBody)) !!}
        </div>
        <div style="margin-top: 20px; font-size: 0.8em; color: #777; text-align: center;">
            <p>&copy; {{ date('Y') }} Nawasena Cyberlabs. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
