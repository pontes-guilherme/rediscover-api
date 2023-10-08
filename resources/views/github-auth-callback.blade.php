<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Callback</title>
    <script>
        window.opener.postMessage({token: "{{ $token }}"}, "{{ env('FRONTEND_URL') }}");

        @if(!env('APP_DEBUG'))
            window.close();
        @else
            console.log("{{ $token }}")
        @endif
    </script>
</head>
<body>
</body>
</html>
