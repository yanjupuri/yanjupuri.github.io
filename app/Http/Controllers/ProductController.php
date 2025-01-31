<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Products;
use App\Models\Revenues;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::select('id', 'title', 'description', 'price', 'image', 'isAvailable', 'status', 'quantity')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()
            ->view('admin.products', compact('products'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');

    }

    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('picture')) {
            $fileNameWithExtension = $request->file('picture')->getClientOriginalName();
            
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            
            $path = $request->file('picture')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        
        $product = new Products();
        
        $product->title = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->pricing;
        $product->image = $fileNameToStore;
        $product->status = $request->condition;
        $product->quantity = $request->quantity;
        
        $product->save();
        
        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function update(Request $request)
    {
        $product = Products::findOrFail($request->id);
    
        $product->title = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->pricing;
        $product->status = $request->condition;
        $product->quantity = $request->quantity;
    
        $quantity = (int)$request->quantity;

        if ($quantity === 0) {
            $product->isAvailable = false;
        }else{
            $product->isAvailable = true;
        }

        if ($request->hasFile('picture')) {
            $fileNameWithExtension = $request->file('picture')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('picture')->storeAs('public/product_images', $fileNameToStore);
    
            if (!empty($product->image)) {
                Storage::disk('public')->delete('product_images/' . $product->image);
            }

            $product->image = $fileNameToStore;
        }
    
        $product->save();
    
        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        $product = Products::findOrFail($id);
    
        Storage::delete('public/product_images/' . $product->image);
    
        $product->delete();
    
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    public function getProductDetails(Request $request)
    {
        $product_id = $request->input('id');

        try {
            $product = Products::findOrFail($product_id);

            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    } 

    public function showById(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Products::find($productId);

        if (!$product) {
            // Handle product not found
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Render the view with product details
        $view = view('marketplace.show_product', compact('product'))->render();

        return response()->json(['view' => $view]);
    }
}
