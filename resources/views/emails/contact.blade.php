<!-- resources/views/emails/contact.blade.php -->
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $details['subject'] }}</title>
</head>
<body>
    <h1>{{ $details['subject'] }}</h1>
    <p>{{ $details['message'] }}</p>

    <p>Adok-Kapok</p>
</body>
</html>
