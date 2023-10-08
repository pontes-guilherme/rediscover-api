<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Callback</title>
    <script>
        console.error("{{ $message }}")

        @if(!env('APP_DEBUG'))
        window.close();
        @endif
    </script>
</head>
<body>
</body>
</html>
