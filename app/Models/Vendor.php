<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function orderLineItems()
    {
        return $this->hasMany(OrderLineItem::class);
    }

    public function productTypeVendors()
    {
        return $this->hasMany(ProductTypeVendor::class);
    }
}
