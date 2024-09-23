<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 + Vue 3</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    test


    <div id="app">
        <FloatingConfigurator/>
    </div>
</body>
</html>
<script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->user()?->jsPermissions() !!}
    }
</script>