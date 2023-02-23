<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentProduct extends Model
{
    use HasFactory;
    protected $table = 'document_products';
    protected $fillable = [
        'title',
        'measure',
        'price',
        'count',
    ];
}
