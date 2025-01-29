<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f7f7f7;">

    <div class="container my-5">
        <div class="row g-4">
            <!-- Product Image Section -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <img src="{{ asset('/storage/products/' . $product->image) }}" class="img-fluid rounded w-100"
                            alt="{{ $product->title }}">
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="col-md-8">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-3">{{ $product->title }}</h3>
                        <p class="text-muted mb-2">Price:
                            <strong>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</strong>
                        </p>
                        <div class="mb-3">
                            <h5>Description:</h5>
                            <p>{!! $product->description !!}</p>
                        </div>
                        <p class="text-muted">Stock Available: <strong>{{ $product->stock }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
