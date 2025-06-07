<?php

namespace App\Http\Controllers;
use Illuminate\Database\Events\TransactionBeginning;
use illuminate\Support\Facades\Validator;
use Auth;

use app\models\Product;
use App\Models\Sale;
use App\Models\Categorie;
use App\Models\Transaction;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    // This controller handles the sale management functionality
    // It includes methods for creating, viewing, updating, and deleting sales
    // Create Product View
    // This function will return the view for creating a new product.
    public function create_sale_view() {
        return view( 'management/sale/create_sale');
    }
    // Create Sale
    // This function will handle the creation of a new Sale.
    public function create_sale(Request $request) {
    // Incoming Fields will validate the information submitted in the Request, comparing it to the rules we declare.
    $cart = $request->input('cart');
    $cartItems = array_map(fn($item) => json_decode($item, true), $cart);
    $userid = Auth::id();
    // Getting Total Quantity and Price for Transaction
    $T_Quantity = null; $T_Price = null;
    foreach($cartItems as $cart) {$T_Quantity+=$cart['quantity']; $T_Price+=$cart['total'];}
    
    // Create Transaction
    $Transaction = Transaction::create(array('UserID' => intval($userid),'Quantity' => $T_Quantity,'TotalPrice' => $T_Price,));
    $Transaction->save();
    echo '<table>';
    foreach($cartItems as $cart) {
        // Create individual Sales
        echo "<tr><td>" . $cart['id'] . "</td>";
        echo "<td>" . $cart['productName'] . "</td>";
        echo "<td>" . $cart['productPrice'] . "</td>";
        echo "<td>" . $cart['quantity'] . "</td>";
        echo "<td>" . $cart['total'] . "</td></tr>";
      $Sale = Sale::insertGetId(array(
        'UserID' => intval($userid), 
        'TransactionID' => $Transaction->id, 
        'ProductID' => $cart['id'], 
        'Quantity' => $cart['quantity'],
        'TotalPrice' => $cart['total']
        ));
    }
    echo '</table>';

   // return redirect("/sale_management/view_sale/{$Transaction}");
   return redirect("/sale_management");
    }

    // This function will return the view for creating a new sale.
    // This function will handle the creation of a new sale.
    public function create_view_transaction_view(Transaction $transaction) {
        $transaction = Transaction::find(id: $transaction->id);
        $Sales = Sale::where('TransactionID',$transaction->id, null)->get();
        
        if (!$transaction) {
            return redirect('/sale_management')->with('error', 'Transaction not found');
        }
        return view('management/sale/view_transaction', ['transaction' => $transaction, 'Sales' => $Sales]);
    }

    public function delete_sale(Sale $sale) {
        $sale = Sale::find(id: $sale->id);
        if (!$sale) {
            return redirect('/sale_management')->with('error', 'Sale not found');
        }

        // Delete the sale
        $sale->delete();

        return redirect('/sale_management')->with('success', 'Sale deleted successfully');
    }

    // Delete Transaction
    public function delete_transaction(Transaction $transaction) {
        if (!$transaction) {
            return redirect('/sale_management')->with('error', 'Transaction not found');
        };
        $sales = Sale::where('TransactionID',$transaction->id)->get();

        foreach($sales as $sale) {
            $sale->delete();
        };
        
        // Delete the sale
        $transaction->delete();

        return redirect('/sale_management')->with('success', 'Sale deleted successfully');
    }

    public function create_update_sale_view(Sale $sale) {
        $sale = Sale::find(id: $sale->id);
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
        $saleID = Sale::find(id: $sale->id);
        if (!$saleID) {
            return redirect('/sale_management')->with('error', 'Sale not found');
        }
        
        // Update the sale
        // Save the sale to the database
        $sale->fill(attributes: $incomingfields)->save();
        return redirect("/sale_management/view_sale/{$sale->id}")->with('success', 'Sale updated successfully');
    }
}
