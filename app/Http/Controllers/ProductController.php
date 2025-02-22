<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|integer',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // Save product to the database
        Product::create($validatedData);

        return redirect()->route('manageproduct', ['access' => 'true']);
    }

    public function index()
    {
        $products = Product::all(); // Fetch all products
        return view('dashboard.home', ['products' => $products]);
    }
    public function indexAdmin()
    {
        $products = Product::all(); // Fetch all products
        return view('secret.admin', ['products' => $products]);
    }
    public function show($product_id)
    {
        $product = Product::findOrFail($product_id); // Retrieve a single product by its ID
        return view('products.show', compact('product'));
    }
    public function search(Request $request)
    {
        // Get the product_name from the request
        $productName = $request->input('name');

        // Search for the first product by name
        $product = Product::where('name', 'like', '%' . $productName . '%')->first();

        // If a product is found, redirect to its details page
        if ($product) {
            return redirect()->route('products.show', ['product_id' => $product->product_id]);
        } else {
            // If no product is found, set a session message
            session()->flash('warning', 'No products found matching your search.');

            // Redirect back to the product list page
            return redirect()->route('home');
        }
    }

}
