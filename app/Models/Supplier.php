<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'suppliers';
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'SupplierName',
        'ContactName',
        'Phone',
        'ContactEmail',
        'Address',
        'City',
        'State',
        'ZipCode',
        'Country',
        'Notes',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'id' => 'integer',
        'SupplierName' => 'string',
        'ContactName' => 'string',
        'Phone' => 'string',
        'ContactEmail' => 'string',
        'Address' => 'string',
        'City' => 'string',
        'State' => 'string',
        'ZipCode' => 'string',
        'Country' => 'string',
        'Notes' => 'string',

    ];
    protected $attributes = [
        'SupplierName' => '',
        'ContactName' => '',
        'Phone' => '',
        'ContactEmail' => '',
        'Address' => '',
        'City' => '',
        'State' => '',
        'ZipCode' => '',
        'Country' => '',
        'Notes' => '',
    ];
}
