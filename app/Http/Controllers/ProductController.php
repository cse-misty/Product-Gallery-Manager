<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request  $request)
    {
        $search = $request->search;

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backend.pages.product.index', compact('products', 'search'));
    }


    public function create()
    {
        return view('backend.pages.product.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array|min:3',
            'images.*' => 'image|mimes:jpeg,png,webp|max:2048'
        ]);

        $product = Product::create([
            'name' => $request->name ?? 'Default Product',
            'description' => $request->description ?? 'Default Description',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');


                $product->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'product' => $product->load('images')
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('backend.pages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('backend.pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'images' => 'nullable|array|min:3',    // new images are optional but must be at least 3 if provided
            'images.*' => 'image|mimes:jpeg,png,webp|max:2048'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name ?? 'Default Product',
            'description' => $request->description ?? 'Default Description',
        ]);

        // Handle new images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::with('images')->find($id);

        if ($product) {
            foreach ($product->images as $image) {
                $fullPath = public_path('storage/' . $image->image_path);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
                $image->delete();
            }

            $product->delete();
            Alert::success('Product deleted successfully');
        } else {
            Alert::error('Product not found');
        }

        return back();
    }
    public function imageDelete($id)
    {
        $image = ProductImage::findOrFail($id);
        $fullPath = public_path('storage/' . $image->image_path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
