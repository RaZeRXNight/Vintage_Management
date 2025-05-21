<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $table = 'sales';
    protected $primaryKey = 'SaleID';
    protected $fillable = [
        'TransactionID',
        'ProductID',
        'Quantity',
        'TotalPrice',
    ];
    public $timestamps = true;
    protected $casts = [
        'SaleID' => 'integer',
        'ProductID' => 'integer',
        'Quantity' => 'integer',
        'TotalPrice' => 'decimal:2',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
    }
    
}
