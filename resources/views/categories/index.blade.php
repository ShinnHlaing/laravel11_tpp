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
                    <a class="nav-link active" href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
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
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        {{-- <h1>Category List</h1> --}}
        <a href="{{ route('categories.create') }}" class="btn btn-outline-success mb-4">Create</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary text-white">Name</th>
                    <th class="bg-primary text-white">Image</th>
                    <th class="bg-primary text-white">Status</th>
                    <th class="bg-primary text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td><img src="{{ asset('categoryImages/' . $category->image) }}" alt="{{ $category->image }}"
                                style="width: 50px; height:50px;"></td>
                        <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-primary mb-3">Edit</a>
                            <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
