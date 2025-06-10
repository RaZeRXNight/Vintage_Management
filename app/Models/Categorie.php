<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    //
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'CategoryName',
        'Description',
    ];
}
