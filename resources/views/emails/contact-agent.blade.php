<!DOCTYPE html>
<html>
<head>
    <title>New Contact Inquiry</title>
</head>
<body>
    <h1>You have a new contact inquiry</h1>
    <p>Here are the details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Phone:</strong> {{ $phone ?? 'Not Provided' }}</li>
        <li><strong>Message:</strong> {{ $message }}</li>
    </ul>
    <p>Please respond to the inquiry as soon as possible.</p>
</body>
</html>
