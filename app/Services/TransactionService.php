<?php

namespace App\Services;


use App\Exceptions\TransactionInvalidException;
use App\Models\Account;
use App\Models\Transaction;

class TransactionService
{

    /**
     * @param Account $account
     * @param Transaction $data
     * @return Transaction|false|\Illuminate\Database\Eloquent\Model
     * @throws TransactionInvalidException
     */
    public function add(Account $account, Transaction $data)
    {
        try {
            return $account
                ->transactions()
                ->save($data);
        } catch (\Exception $e) {
            report($e);
            throw new TransactionInvalidException('A transação informada é inválida');
        }
    }

}
