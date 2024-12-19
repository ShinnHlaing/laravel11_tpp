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
    {{-- <h1>This is Categories</h1>
    <a href="{{ route('categories.create') }}">+ create</a>
    @foreach ($categories as $item)
        <p>{{ $item['id'] }}::{{ $item['name'] }}</p>
        <a href="{{ route('categories.edit', ['id' => $item['id']]) }}">+ edit</a>
        <form action="{{ route('categories.delete', $item->id) }}" method="POST">
            @csrf
            <button>delete</button>
        </form>
    @endforeach --}}
    <div class="container">
        <h1>Category List</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-outline-success mb-4">Create</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="bg-primary text-white">ID</th>
                    <th class="bg-primary text-white">NAME</th>
                    <th class="bg-primary text-white">IMAGE</th>
                    <th class="bg-primary text-white">STATUS</th>
                    <th class="bg-primary text-white">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <th>{{ $item['id'] }}</th>
                        <th>{{ $item['name'] }}</th>
                        <th>
                            <img src="{{ asset('categoryImages/' . $item->image) }}" alt="{{ $item->image }}"
                                style="width: 50px; height:50px;">
                        </th>
                        @if ($item['status'] == 1)
                            <th>Active</th>
                        @else
                            <th>Inactive</th>
                        @endif

                        <th class="d-flex">
                            <a href="{{ route('categories.edit', ['id' => $item['id']]) }}"
                                class="btn btn-outline-secondary me-2">Edit</a>
                            <form action="{{ route('categories.delete', $item->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger">Delete</button>
                            </form>
                        </th>
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
