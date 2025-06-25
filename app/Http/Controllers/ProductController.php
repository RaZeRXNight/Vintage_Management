<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // This function will return the view for product management.
    public function create_product_management_view() {
        $Verification = UserController::VerifyUser();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }
        // Retrieve all products from the database
        $products = Product::all();
        $categories = Categorie::all();
        $orders = Order::all();
        $suppliers = Supplier::all();
        // Return the view with the products
        return view('management/product/product_management', ['products' => $products, 'categories' => $categories, 'orders' => $orders, 'suppliers' => $suppliers]);
    }

    // This controller handles the product management functionality
    // It includes methods for creating, viewing, updating, and deleting products
    public function create_view_product_view(Product $product) {
        $Verification = UserController::VerifyUser();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $product = Product::find(id: $product->id);
        if (!$product) {
            return redirect('/product_management')->with('error', 'Product not found');
        }

        return view('management/product/view_product', ['product' => $product]);
    }

    public function delete_product(Product $product) {
        $Verification = UserController::VerifyUser_Admin();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $product = Product::find(id: $product->id);
        if (!$product) {
            return redirect('/product_management')->with('error', 'Product not found');
        }

        // Delete the product
        $product->delete();

        return redirect('/product_management')->with('success', 'Product deleted successfully');
    }

    public function create_update_product_view(Product $product) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $product = Product::find(id: $product->id);
        $Categories = DB::table('categories')->get();
        $Suppliers = DB::table('suppliers')->get();
        if (!$product) {
            return redirect('/product_management')->with('error', 'Product not found');
        }

        return view('management/product/update_product', ['product' => $product, 'Categories' => $Categories, 'Suppliers' => $Suppliers]);
    }

    public function update_product(Request $request, Product $product) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        // Incoming Fields will validate the information submitted in the Request, comparing it to the rules we declare.
        $incomingfields = $request->validate([
            'ProductIMG' => ['nullable', 'image', 'max:4096'],
            'SupplierID' => ['min:0', 'max:1000'],
            'ProductName' => ['required', 'min:0', 'max:50'], 
            'CategoryID' => ['min:0', 'max:1000'],
            'Description' => ['nullable', 'min:0', 'max:50'],
            'Size' => ['required'],
            'BuyPrice' => ['nullable', 'min:0', 'max:50'],
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
        $Verification = UserController::VerifyUser();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }
        return view('management/product/create_product');
    }
    public function create_product(Request $request) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }
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

    // -----------------------------------------------
    // This function will return the view for creating a new category.
    public function create_category_view() {
        $Verification = UserController::VerifyUser();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }
        return view('management/product/category/create_category');
    }
    // This function will create a new category.
    public function create_category(Request $request) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        // Validate the incoming request data
        $incomingfields = $request->validate([
            'CategoryName' => ['required', 'min:0', 'max:50']
        ]);

        // Create a new category using the validated data
        $category = Categorie::create($incomingfields);

        // Redirect to the product management view with a success message
        if (!$category) {
            return redirect('/product_management')->with('error', 'Failed to create category');
        }
        // Redirect to the view of the newly created category
        return redirect("/product_management")->with('success', 'Category created successfully');
    }

    // This function will delete a category.
    public function delete_category(Categorie $category) {
        $Verification = UserController::VerifyUser_Admin();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $category = Categorie::find(id: $category->id);
        if ($category) {
            $category->delete();
            return redirect("/product_management")->with('success', 'Category deleted successfully');
        }
        return redirect("/product_management")->with('error', 'Category not found');
    }

    // This function will return the view for updating a category.
    public function create_update_category_view(Categorie $category) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $category = Categorie::find(id: $category->id);
        if (!$category) {
            return redirect('/product_management')->with('error', 'Category not found');
        }
        return view('management/product/category/update_category', ['category' => $category]);
    }

    // ----------------------------------------------------------
    // This function will create the view for creating a new supplier.
    public function create_supplier_view() {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        return view('management/product/supplier/create_supplier');
    }
    // This function will create a new supplier.
    public function create_supplier(Request $request) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        // Validate the incoming request data
        $incomingfields = $request->validate([
            'SupplierName' => ['required', 'min:0', 'max:50'],
            'ContactName' => ['nullable', 'min:0', 'max:50'],
            'Phone' => ['nullable', 'min:0', 'max:50'],
            'ContactEmail' => ['nullable', 'min:0', 'max:50'],
        ]);

        // Create a new supplier using the validated data
        $supplier = Supplier::create($incomingfields);

        // Redirect to the product management view with a success message
        if (!$supplier) {
            return redirect('/product_management')->with('error', 'Failed to create supplier');
        }
        // Redirect to the view of the newly created supplier
        return redirect("/product_management")->with('success', 'Supplier created successfully');
    }
    // This function will delete a supplier.
    public function delete_supplier(Supplier $supplier) {
        $Verification = UserController::VerifyUser_Admin();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }
        $supplier = Supplier::find(id: $supplier->id);
        if ($supplier) {
            $supplier->delete();
            return redirect("/product_management")->with('success', 'Supplier deleted successfully');
        }
        return redirect("/product_management")->with('error', 'Supplier not found');
    }
    // This function will return the view for updating a supplier.
    public function create_update_supplier_view(Supplier $supplier) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $supplier = Supplier::find(id: $supplier->id);
        if (!$supplier) {
            return redirect('/product_management')->with('error', 'Supplier not found');
        }
        return view('management/product/supplier/update_supplier', ['supplier' => $supplier]);
    }
    // This function will update a supplier.
    public function update_supplier(Request $request, Supplier $supplier) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        // Validate the incoming request data
        $incomingfields = $request->validate([
            'SupplierName' => ['required', 'min:0', 'max:50'],
            'ContactName' => ['nullable', 'min:0', 'max:50'],
            'Phone' => ['nullable', 'min:0', 'max:50'],
            'ContactEmail' => ['nullable', 'min:0', 'max:50'],
        ]);

        // Find the supplier by ID
        $supplierID = Supplier::find(id: $supplier->id);
        if (!$supplierID) {
            return redirect('/product_management')->with('error', 'Supplier not found');
        }

        // Update the supplier
        $supplier->fill(attributes: $incomingfields)->save();
        return redirect("/product_management/view_supplier/{$supplier->id}")->with('success', 'Supplier updated successfully');
    }
    // This function will return the view for viewing a supplier.
    public function create_view_supplier_view(Supplier $supplier) {
        $Verification = UserController::VerifyUser();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $supplier = Supplier::find(id: $supplier->id);
        if (!$supplier) {
            return redirect('/product_management')->with('error', 'Supplier not found');
        }

        return view('management/product/supplier/view_supplier', ['supplier' => $supplier]);
    }
    // ----------------------------------------------------------
    // This function will create the view for creating a new order.
    public function create_order_view() {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $suppliers = Supplier::all();
        $products = Product::all();
        return view('management/product/order/create_order', ['suppliers' => $suppliers, 'products' => $products]);
    }
    // This function will create a new order.
    public function create_order(Request $request) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }
        // Validate the incoming request data
        $incomingfields = $request->validate([
            'SupplierID' => ['required', 'min:0', 'max:1000'],
            'ProductID' => ['required', 'min:0', 'max:1000'],
            'OrderDate' => ['required', 'date'],
            'RequiredDate' => ['required', 'date'],
            'ShippedDate' => ['nullable', 'date'],
            'Status' => ['required', 'min:0', 'max:50'],
            'Comments' => ['nullable', 'min:0', 'max:255']
        ]);

        // Create a new order using the validated data
        $order = Order::create($incomingfields);

        // Redirect to the product management view with a success message
        if (!$order) {
            return redirect('/product_management')->with('error', 'Failed to create order');
        }
        // Redirect to the view of the newly created order
        return redirect("/product_management")->with('success', 'Order created successfully');
    }
    // This function will delete an order.
    public function delete_order(Order $order) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }
        $order = Order::find(id: $order->id);
        if ($order) {
            $order->delete();
            return redirect("/product_management")->with('success', 'Order deleted successfully');
        }
        return redirect("/product_management")->with('error', 'Order not found');
    }
    // This function will return the view for updating an order.
    public function create_update_order_view(Order $order) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $order = Order::find(id: $order->id);
        if (!$order) {
            return redirect('/product_management')->with('error', 'Order not found');
        }
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('management/product/order/update_order', ['order' => $order, 'suppliers' => $suppliers, 'products' => $products]);
    }
    // This function will update an order.
    public function update_order(Request $request, Order $order) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        // Validate the incoming request data
        $incomingfields = $request->validate([
            'SupplierID' => ['required', 'min:0', 'max:1000'],
            'ProductID' => ['required', 'min:0', 'max:1000'],
            'OrderDate' => ['required', 'date'],
            'RequiredDate' => ['required', 'date'],
            'ShippedDate' => ['nullable', 'date'],
            'Status' => ['required', 'min:0', 'max:50'],
            'Comments' => ['nullable', 'min:0', 'max:255']
        ]);

        // Find the order by ID
        $orderID = Order::find(id: $order->id);
        if (!$orderID) {
            return redirect('/product_management')->with('error', 'Order not found');
        }

        // Update the order
        $order->fill(attributes: $incomingfields)->save();
        return redirect("/product_management/view_order/{$order->id}")->with('success', 'Order updated successfully');
    }
    // This function will return the view for viewing an order.
    public function create_view_order_view(Order $order) {
        $Verification = UserController::VerifyUser_Inventory();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return redirect($Verification);
        }

        $order = Order::find(id: $order->id);
        if (!$order) {
            return redirect('/product_management')->with('error', 'Order not found');
        }

        return view('management/product/order/view_order', ['order' => $order]);
    }
}