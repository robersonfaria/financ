<?php

namespace App\Models;

use App\Enums\Operations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'external_code',
        'description',
        'operation',
        'value',
        'consolidated'
    ];

    protected $enumCasts = [
        'operation' => Operations::class
    ];

    protected $casts = [
        'value' => 'float',
        'consolidated' => 'boolean'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function origin()
    {
        return $this->morphTo();
    }
}
