<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="background: rgba(69, 150, 231, 0.872); color: white">
    <h1>Article!</h1>
    <ul>
        @foreach ($articles as $article)
            <li style="list-style-type: none">{{ $article['name'] }} => {{ $article['Title'] }}</li>
        @endforeach
    </ul>
</body>

</html>
