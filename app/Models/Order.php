<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'person_id'];

    protected $with = ['address', 'items'];

    /**
     * @return HasOne
     */
    public function person()
    {
        return $this->hasOne('App\Models\Person');
    }

    /**
     * @return HasOne
     */
    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

    /**
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
}
