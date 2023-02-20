<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chief extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'used_product',
        'worker_name',
        'commit',
    ];
}
