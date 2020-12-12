<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Item
 * @package App\Models
 */
class Item extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'note', 'quantity', 'price', 'order_id'];

    /**
     * @return HasOne
     */
    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }
}
