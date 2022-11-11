<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }
}
