<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','used_product','commit'];

    public function products(){
        return $this->hasMany(Product::class,'client_id','id');
    }


}
