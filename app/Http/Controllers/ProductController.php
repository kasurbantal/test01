<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private const IMAGE_STORAGE_PATH = 'public/products';

    /**
     * Display a listing of the products.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'));
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified product.
     */
    public function show(string $id): View
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $validated = $this->validateProduct($request, false);

        if ($request->hasFile('image')) {
            Storage::delete(self::IMAGE_STORAGE_PATH . '/' . $product->image);
            $validated['image'] = $this->storeImage($request->file('image'));
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        Storage::delete(self::IMAGE_STORAGE_PATH . '/' . $product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Data Berhasil Dihapus!');
    }

    /**
     * Validate the product request data.
     */
    private function validateProduct(Request $request, bool $isNew = true): array
    {
        $rules = [
            'title'       => 'required|string|min:5',
            'description' => 'required|string|min:10',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ];

        if ($isNew || $request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
        }

        return $request->validate($rules, [
            'image.required' => 'Gambar produk wajib diisi.',
            'image.image'    => 'File yang diunggah harus berupa gambar.',
            'image.mimes'    => 'Format gambar harus berupa JPEG, JPG, atau PNG.',
            'image.max'      => 'Ukuran gambar maksimal adalah 2 MB.',
            'title.min'      => 'Judul produk minimal harus memiliki 5 karakter.',
        ]);
    }

    /**
     * Store the uploaded image and return its hash name.
     */
    private function storeImage($image): string
    {
        $image->storeAs(self::IMAGE_STORAGE_PATH, $image->hashName());
        return $image->hashName();
    }
}
