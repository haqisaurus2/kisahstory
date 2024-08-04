<!-- resources/views/react.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>React in Laravel</title>
    @viteReactRefresh
    @vite(['resources/react/app.tsx'])
</head>
<body style="margin:0;padding:0">
    <div id="app"></div>
</body>
</html>