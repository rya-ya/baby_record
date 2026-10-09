<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable=[
        'baby_id',
        'day',
        'memo'
    ];

    public function baby()
    {
        return $this->belongsTo(Baby::class);
    }

    public function milks()
    {
        return $this->hasMany(Milk::class);
    }

    public function diapers()
    {
        return $this->hasMany(Diaper::class);
    }

    public function sleeps()
    {
        return $this->hasMany(Sleep::class);
    }

}
