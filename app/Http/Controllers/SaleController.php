<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Transaction;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    // This controller handles the sale management functionality
    // It includes methods for creating, viewing, updating, and deleting sales
    // Create Product View
    // This function will return the view for creating a new product.
    public function create_sale_view() {
        return view('management/sale/create_sale');
    }
    // Create Sale
    // This function will handle the creation of a new Sale.
    public function create_sale(Request $request) {
    // Incoming Fields will validate the information submitted in the Request, comparing it to the rules we declare.
    echo "<script>alert('Hello World');</script>";
    $cart = $request->input('cart');
    $cartItems = array_map(fn($item) => json_decode($item, true), $cart);

    var_dump($cartItems);


    
    $incomingfield = $cart->validate([
        'id' => ['required'],

    ]);
    

    /* $incomingfields = $request->validate([
        'ProductID' => ['required', 'min:0', 'max:1000'],
        'Quantity' => ['required', 'min:0', 'max:1000'],
        'TotalPrice' => ['required', 'min:0', 'max:10000']
    ]); */
    // $sale = Sale::create($incomingfields);
    // return redirect("/sale_management/view_sale/{$incomingfields['ProductID']}");
    }

    // This function will return the view for creating a new sale.
    // This function will handle the creation of a new sale.
    public function create_view_sale_view(Sale $sale) {
        $sale = Sale::find(id: $sale->ID);
        if (!$sale) {
            return redirect('/sale_management')->with('error', 'Sale not found');
        }

        return view('management/sale/view_sale', ['sale' => $sale]);
    }

    public function delete_sale(Sale $sale) {
        $sale = Sale::find(id: $sale->ID);
        if (!$sale) {
            return redirect('/sale_management')->with('error', 'Sale not found');
        }

        // Delete the sale
        $sale->delete();

        return redirect('/sale_management')->with('success', 'Sale deleted successfully');
    }

    public function create_update_sale_view(Sale $sale) {
        $sale = Sale::find(id: $sale->ID);
        if (!$sale) {
            return redirect('/sale_management')->with('error', 'Sale not found');
        }

        return view('management/sale/update_sale', ['sale' => $sale]);
    }

    public function update_sale(Request $request, Sale $sale) {
        // Incoming Fields will validate the information submitted in the Request, comparing it to the rules we declare.
        $incomingfields = $request->validate([
            'ProductID' => ['required', 'min:0', 'max:1000'],
            'CustomerID' => ['required', 'min:0', 'max:1000'],
            'Quantity' => ['required', 'min:0', 'max:1000'],
            'SaleDate' => ['required'],
            'TotalPrice' => ['required', 'min:0', 'max:10000']
        ]);

        // Find the sale by ID
        $saleID = Sale::find(id: $sale->ID);
        if (!$saleID) {
            return redirect('/sale_management')->with('error', 'Sale not found');
        }
        
        // Update the sale
        // Save the sale to the database
        $sale->fill(attributes: $incomingfields)->save();
        return redirect("/sale_management/view_sale/{$sale->ID}")->with('success', 'Sale updated successfully');
    }
}
