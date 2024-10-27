<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <base href="/">
    @vite('resources/js/app.js')
    @routes
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>