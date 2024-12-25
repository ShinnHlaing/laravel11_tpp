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
                Edit User
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="text" value="{{ $user->name }}" name="name" placeholder="Enter User Name"
                        id="" class="form-control card-body" />
                    <input type="text" value="{{ $user->email }}" name="email" placeholder="Enter User Email"
                        id="" class="form-control card-body" />
                    <input type="text" value="{{ $user->created_at }}" name="date" placeholder="Choose Date"
                        id="" class="form-control card-body" />
                </div>
                {{-- <div class="card-body">
                    <img src="{{ asset('categoryImages/' . $category->image) }}" alt="{{ $category->image }}"
                        style="width: 50px; height:50px;">
                    <input type="file" name="image" class="form-control mt-2">
                </div>
                <div class="form-check form-switch form-control">
                    <label for="" class="form-check-label">
                        Active or Inactive
                    </label>
                    <input type="checkbox" name="status" id="" class="form-check-input" role="switch"
                        {{ $category->status ? 'checked' : '' }}>
                </div> --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
