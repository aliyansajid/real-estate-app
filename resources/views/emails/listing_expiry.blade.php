<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Listing is About to Expire</title>
</head>
<body>
    <h2>Your listing "{{ $listingTitle }}" is about to expire on {{ $expiryDate }}.</h2>
    <p>Click the link below to keep it active for another 30 days:</p>
    <a href="{{ $reactivationLink }}">Keep Listing Active</a>
</body>
</html>
