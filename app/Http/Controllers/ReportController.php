<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;

class ReportController extends Controller
{
    //
    public function create_report_management_view()
    {
        $Product = Product::all();
        $Sale = Sale::all();
        $Transaction = Transaction::all();
        
        // Checking if User is Authenticated as Admin.
        if (auth()->user() == null) {
            return redirect('/')->with('error', 'You do not have permission to access this page.');
            
            if (auth()->user()->role !== 'admin') {
                return redirect('/')->with('error', 'You do not have permission to access this page.');
            };
        };

        // Returning View with Data
        return view('management.report.report_management', [
            'Product' => $Product,
            'Sale' => $Sale,
            'Transaction' => $Transaction
        ]);
    }
    
}
