<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>This is Categories</h1>
    <a href="{{ route('categories.create') }}">+ create</a>
    @foreach ($categories as $item)
        <p>{{ $item['id'] }}::{{ $item['name'] }}</p>
    @endforeach
</body>

</html>
