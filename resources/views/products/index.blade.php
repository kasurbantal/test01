<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Data Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background-color: #f8f9fa;">

    <div class="container py-5">
        <h3 class="text-center mb-4">Product Management Dashboard</h3>
        <div class="card shadow rounded border-0">
            <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col" class="text-center" style="width: 20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/products/' . $product->image) }}"
                                            alt="Product Image" class="img-thumbnail" style="width: 120px;">
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Are you sure?');"
                                            action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="btn btn-dark btn-sm">View</a>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No product data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Display flash messages using SweetAlert2
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>

</html>
