<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['name','species','age','price','description','image','category_id'];
    public function category() { return $this->belongsTo(Category::class); }


}
