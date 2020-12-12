<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Person
 * @package App\Models
 */
class Person extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    protected $with = ['phones'];

    /**
     * @return HasMany
     */
    public function phones() {
        return $this->hasMany('App\Models\Phone');
    }
}
