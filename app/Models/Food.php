<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable=[
      'name','description','price','category_id','image'
    ];
    public function category(){
        return $this->belongsToMany(Category::class,'id','category_id');
    }
    public function categorys(){
        return$this->belongsToMany(Category::class);
    }
    use HasFactory;
}
