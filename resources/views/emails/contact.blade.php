<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        p {
            font-weight: normal;
        }
    </style>
</head>
<body>
    <h3>New Contact Form Submission</3>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
