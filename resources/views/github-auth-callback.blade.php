<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Callback</title>
    <script>
        window.opener.postMessage({token: "{{ $token }}"}, "{{ env('FRONTEND_URL') }}");
        window.close();
    </script>
</head>
<body>
</body>
</html>
