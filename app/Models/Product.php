<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'creative_id',
        'product_type_id',
        'deleted_at'
    ];

    public function creative()
    {
        return $this->belongsTo(Creative::class);
    }

    public function orderLineItems()
    {
        return $this->hasMany(OrderLineItem::class);
    }
}
