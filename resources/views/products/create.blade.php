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

    <div class="container">
        {{-- error check --}}
        @if ($errors->any())
            <div class="text-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card mt-4">
            <div class="card-header">
                Create New Product
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Enter Product Name" id=""
                    class="form-control card-body" />
                <input type="text" name="description" placeholder="Enter Product Description" id=""
                    class="form-control card-body" />
                <input type="text" name="price" placeholder="Enter Price" id=""
                    class="form-control card-body" />
                <input type="file" name="image" class="form-control card-body" />
                <select name="" class="form-select" id="">
                    @foreach ($products as $product)
                        <option value="">{{ $product->category->name }}</option>
                    @endforeach
                </select>
                <div class="card-body">
                    <div class="form-check form-switch">
                        <label for="" class="form-check-label">
                            Success or Pending
                        </label>
                        <input type="checkbox" name="status" id="" class="form-check-input" role="switch"
                            checked>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
