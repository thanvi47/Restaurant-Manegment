<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $fillable=[
      'category_id',
      'food_id'
    ];
    public function FoodCategory(){
        return $this->belongsToMany(FoodCategory::class,'id','food_id');
    }
    use HasFactory;
}
