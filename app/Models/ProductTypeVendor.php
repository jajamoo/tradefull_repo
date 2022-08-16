<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeVendor extends Model
{
    use HasFactory;

    protected $table = 'product_type_vendor';

    protected $fillable = [
        'product_type_id',
        'vendor_id',
    ];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
