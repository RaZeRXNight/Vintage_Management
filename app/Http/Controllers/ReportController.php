<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;


class ReportController extends Controller
{
    //
    public function create_report_management_view()
    {
        // Checking if User is Authenticated as Admin.
        $Verification = UserController::VerifyUser_Admin();
        if ($Verification instanceof \Illuminate\Http\RedirectResponse) {
            return $Verification;
        }

        $Product = Product::all();
        $Sale = Sale::all();
        $Transaction = Transaction::all();
        
        // Returning View with Data
        return view('management.report.report_management', [
            'Product' => $Product,
            'Sale' => $Sale,
            'Transaction' => $Transaction
        ]);
    }
    
}
