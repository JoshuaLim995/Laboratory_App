<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name', 'category','photo','measurement_unit'];
    // 'model',
    // 'asset_code',
    
    // 'description',
    // 'room',
    // 'floor_no',
    
    // 'quantity',
    
    

    public static $categories = [
    'gls' => 'Laboratory glassware‎/Tools',
    'che' => 'Chemical',
    'eqp' => 'Equipment',
    'con' => 'Laboratory Consumable',
    'ict' => 'ICT Consumable/Hardware',
    ];

    // public function category()
    // {
    // 	return $this->belongsTo(Category::class);
    // }

    public function locations()
    {
        return $this->hasMany(ItemLocation::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function getCategory()
    {
        return Inventory::$categories[$this->category];
        // $inventory->categories($inventory->category); use this to show category
    }
}
