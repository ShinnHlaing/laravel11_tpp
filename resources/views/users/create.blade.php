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
                Create User
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Enter User Name" id=""
                    class="form-control card-body" />
                <input type="email" name="email" placeholder="Enter Email Address" id=""
                    class="form-control card-body" />
                <input type="date" name="created_at" placeholder="Choose Date" id=""
                    class="form-control card-body" />
                {{-- <input type="file" name="image" class="form-control card-body" /> --}}
                {{-- <div class="card-body">
                    <div class="form-check form-switch">
                        <label for="" class="form-check-label">
                            Active or inactive
                        </label>
                        <input type="checkbox" name="status" id="" class="form-check-input" role="switch"
                            checked>
                    </div>
                </div> --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
