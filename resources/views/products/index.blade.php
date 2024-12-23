<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark sticky-top mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Stocks</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <a href="{{ route('products.create') }}" class="btn btn-outline-success mb-4 ">Create</a>
        <div class="row">
            @foreach ($products as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('productImages/' . $item->image) }}" class="card-img-middle"
                            alt="{{ $item->image }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><strong>Price:</strong> {{ $item->price }}</p>
                            <p class="card-text"><strong>Category:</strong> {{ $item['category']['name'] }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ $item->status ? 'Success' : 'Pending' }}
                            </p>
                            <a href="{{ route('products.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('products.delete', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
