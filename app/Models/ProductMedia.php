<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductMedia extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'path',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * 媒體所屬商品。
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
