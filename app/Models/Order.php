<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'person_id'];

    /**
     * @return HasOne
     */
    public function person()
    {
        return $this->hasOne('App\Models\Person');
    }
}
