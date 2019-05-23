<?php

namespace App\Repositories\Contracts;


use App\Models\Account;

interface TransactionRepositoryContract
{

    public function add(Account $account, string $operation, float $value): TransactionRepositoryContract;
}
