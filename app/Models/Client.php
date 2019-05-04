<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_clients');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
