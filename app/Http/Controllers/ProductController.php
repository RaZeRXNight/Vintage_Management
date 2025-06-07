<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // This controller handles the product management functionality
    // It includes methods for creating, viewing, updating, and deleting products
    public function create_view_product_view(Product $product) {
        $product = Product::find(id: $product->id);
        if (!$product) {
            return redirect('/product_management')->with('error', 'Product not found');
        }

        return view('management/product/view_product', ['product' => $product]);
    }

    public function delete_product(Product $product) {
        $product = Product::find(id: $product->id);
        if (!$product) {
            return redirect('/product_management')->with('error', 'Product not found');
        }

        // Delete the product
        $product->delete();

        return redirect('/product_management')->with('success', 'Product deleted successfully');
    }

    public function create_update_product_view(Product $product) {
        $product = Product::find(id: $product->id);
        if (!$product) {
            return redirect('/product_management')->with('error', 'Product not found');
        }

        return view('management/product/update_product', ['product' => $product]);
    }

    public function update_product(Request $request, Product $product) {
        // Incoming Fields will validate the information submitted in the Request, comparing it to the rules we declare.
        $incomingfields = $request->validate([
            'ProductIMG' => ['nullable', 'image', 'max:4096'],
            'SupplierID' => ['min:0', 'max:1000'],
            'ProductName' => ['required', 'min:0', 'max:50'], 
            'CategoryID' => ['min:0', 'max:1000'],
            'Description' => ['nullable', 'min:0', 'max:50'],
            'UnitPrice' => ['required', 'min:0', 'max:1000'],
            'UnitsInStock' => ['required', 'min:0', 'max:1000'],
            'UnitsOnOrder' => ['required', 'min:0', 'max:1000'],
            'ReorderLevel' => ['required', 'min:0', 'max:10'],
            'Discontinued' => ['required']
        ]);

        // The ImageUploadController is used to upload the image to the server.
        // The ImageUploadController will return the path to the image, which is then stored in the ProductIMG field.
        if($request->hasFile('ProductIMG')) { // Check if the request has a file
            echo $incomingfields['ProductIMG']; 
            $imageUploadController = new ImageUploadController(); // Create an instance of ImageUploadController
            // Call the upload method with the request
            $incomingfields['ProductIMG'] = $imageUploadController->upload($request, 'uploads/product_images'); 
        } 
        // Find the product by ID
        $productID = Product::find(id: $product->id);
        if (!$productID) {
            return redirect('/product_management')->with('error', 'Product not found');
        }
        
        // Update the product
        // Save the product to the database
        $product->fill(attributes: $incomingfields)->save();
        return redirect("/product_management/view_product/{$product->id}")->with('success', 'Product updated successfully');
    }

    // Create Product View
    // This function will return the view for creating a new product.
    public function create_product_view() {
        return view('management/product/create_product');
    }
    public function create_product(Request $request) {
    // Incoming Fields will validate the information submitted in the Request, comparing it to the rules we declare.

    $incomingfields = $request->validate([
        'Amount' => ['nullable'],
        'ProductIMG' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        'SupplierID' => ['min:0', 'max:1000'],
        'CategoryID' => ['min:0', 'max:1000'],
        'ProductName' => ['required', 'min:0', 'max:50'], 
        'Size' => ['required'],
        'Description' => ['nullable', 'min:0', 'max:50'],
        'UnitPrice' => ['required', 'min:0', 'max:1000'],
        'UnitsInStock' => ['nullable', 'min:0', 'max:1000'],
        'UnitsOnOrder' => ['nullable', 'min:0', 'max:1000'],
        'ReorderLevel' => ['nullable', 'min:0', 'max:10'],
        'Discontinued' => ['required']
    ]);

    // The ImageUploadController is used to upload the image to the server.
    // The ImageUploadController will return the path to the image, which is then stored in the ProductIMG field.


    if($request->hasFile('ProductIMG')) { // Check if the request has a file
        echo $incomingfields['ProductIMG']; 
        $imageUploadController = new ImageUploadController(); // Create an instance of ImageUploadController
        // Call the upload method with the request
        $incomingfields['ProductIMG'] = $imageUploadController->upload($request, 'storage'); 
    } 

    if ($request['Amount'] && $request['Amount'] == 1) {
        $Standard_Size = ['S', 'M', 'L', "XL", 'XXL'];
        foreach($Standard_Size as $Size) {
            $product = $incomingfields;
            $product['ProductName'].= ' ' . $Size; 
            $product['Size'] = $Size;
            
            $product = Product::create($product);
        }
        return redirect("/product_management/");
    } else {
        $product = Product::create($incomingfields);
        return redirect("/product_management/view_product/{$product->id}");
    }
    }

    

    // This function will retrieve all products from the database and return them to the view.
    public function get_all_products() {
        return Product::all();
    }

   // This function will retrieve a product by its ID from the database and return it.
   public function get_product_by_id($id) {
       return Product::find($id);
   }

}
