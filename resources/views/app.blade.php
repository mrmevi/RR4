<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @routes

    @inertiaHead
</head>
<body style="margin: 0; padding: 0">
@routes
@vite('resources/js/app.js')
@inertia
<a href="{{redirect()->back()}}"></a>
</body>
</html>
