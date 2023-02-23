<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $fillable = ['name','address','commit','role_id','user_id'];

    public function products(){
        return $this->hasMany(DocumentProduct::class,'document_id','id');
    }

}
