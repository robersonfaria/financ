<?php

namespace App\Models;

use App\Enums\Operations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'description',
        'operation',
        'recurrence',
        'alert'
    ];

    protected $enumCasts = [
        'operation' => Operations::class
    ];

    protected $casts = [
        'recurrence' => 'array',
        'alert' => 'array'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'origin');
    }
}
