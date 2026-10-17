<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLike extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    /**
     * 這筆點讚所屬的會員。
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 這筆點讚所屬的商品。
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
