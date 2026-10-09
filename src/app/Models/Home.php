<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Home extends Model
{
    protected $fillable = [
        'name' ,
        'user_id' ,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function babies()
    {
        return $this->hasMany(Baby::class);
    }
}
