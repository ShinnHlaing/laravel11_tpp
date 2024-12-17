<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ route('products.create') }}">+create</a>
    @foreach ($products as $item)
        <p>{{ $item['id'] }}=>{{ $item['name'] }}=>{{ $item['description'] }}==><span>$</span>{{ $item['price'] }}</p>
        {{-- <a href="{{ route('categories.show', ['id' => $item['id']]) }}">+ show</a> --}}
        <a href="{{ route('products.show', ['id' => $item['id']]) }}">show product</a>
        <form action="{{ route('products.delete', $item->id) }}" method="POST">
            @csrf
            <button>delete</button>
        </form>
    @endforeach
</body>

</html>
