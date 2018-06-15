<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
    'name', 
    'model',
    'category_id',
    'description',
    'photo',
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
