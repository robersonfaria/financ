<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Services\TransactionService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'due_date'
    ];

    protected $enumCasts = [
        'type' => AccountType::class
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
