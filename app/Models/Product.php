<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'ID';

    /** @var list<string> */
    protected $fillable = [
        'ProductName',
        'ProductIMG',
        'SupplierID',
        'CategoryID',
        'Description',
        'UnitPrice',
        'UnitsInStock',
        'UnitsOnOrder',
        'ReorderLevel',
        'Discontinued',
        
    ];
    protected $casts = [
        'Discontinued' => 'boolean',
        'UnitsInStock' => 'integer',
        'UnitsOnOrder' => 'integer',
        'ReorderLevel' => 'integer',
        'UnitPrice' => 'float'
    ];
    protected $attributes = [
        'Discontinued' => false,
        'UnitsInStock' => 0,
        'UnitsOnOrder' => 0,
        'ReorderLevel' => 0,
        'UnitPrice' => 0.00
    ];
}
