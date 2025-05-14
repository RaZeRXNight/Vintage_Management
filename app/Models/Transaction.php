<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = 'transactions';
    protected $primaryKey = 'TransactionID';
    protected $fillable = [
        'UserID',
        'Quantity',
        'TotalPrice',
        'PaymentMethod',
        'TransactionStatus',
    ];
    public $timestamps = true;
    protected $casts = [
        'TransactionID' => 'integer',
        'UserID' => 'integer',
        'Quantity' => 'integer',
        'TotalPrice' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
    public function sale()
    {
        return $this->hasMany(Sale::class, 'TransactionID', 'TransactionID');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'ProductID', 'ProductID');
    }
}
