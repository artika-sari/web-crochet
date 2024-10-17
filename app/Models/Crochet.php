<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class crochet extends Model
{
    use HasFactory;

    public $table = 'crochets';
    
    protected $fillable = [
        'type', 'name', 'price', 'stock'
    ];
}
