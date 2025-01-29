<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Edit Product</h3>
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" id="image"
                                    class="form-control @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Product Title</label>
                                <input type="text" id="title"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title', $product->title) }}" placeholder="Enter product title">
                                @error('title')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Product Description</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                    rows="4" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Product Price</label>
                                        <input type="number" id="price"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price', $product->price) }}"
                                            placeholder="Enter product price">
                                        @error('price')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Product Stock</label>
                                        <input type="number" id="stock"
                                            class="form-control @error('stock') is-invalid @enderror" name="stock"
                                            value="{{ old('stock', $product->stock) }}"
                                            placeholder="Enter product stock">
                                        @error('stock')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>

</html>
