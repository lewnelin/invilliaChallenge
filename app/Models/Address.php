<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Address
 * @package App\Models
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'city', 'country', 'order_id'];

    /**
     * @return HasOne
     */
    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }
}
