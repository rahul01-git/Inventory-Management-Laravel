<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suppliers</title>
</head>

<body>
    <div class="container">
        <h1 class="text-danger">supplier's database</h1>
        @foreach ($suppliers as $supplier)
            <div class="row">
                <h3>{{ $supplier->name }}</h3>
                <img src="{{ url('/uploads/supplier/' . $supplier->image) }}" alt="supplier image" width="80">
            </div>
        @endforeach
    </div>
</body>

</html>
