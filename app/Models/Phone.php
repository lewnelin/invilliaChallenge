<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Phone
 * @package App\Models
 */
class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'person'];

    /**
     * @return HasOne
     */
    public function person()
    {
        return $this->hasOne('App\Models\Person');
    }
}
