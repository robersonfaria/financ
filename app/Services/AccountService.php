<?php

namespace App\Services;


use App\Enums\Operations;
use App\Models\Account;
use App\Models\Transaction;

class AccountService
{

    /**
     * @param Account $account
     * @return float
     */
    public function balance(Account $account): float
    {
        $lastBalance = $account->transactions()
            ->where('operation', '=', Operations::Balance)
            ->latest()
            ->first();

        $transactions = $account->transactions()
            ->where('created_at', '>=', $lastBalance->created_at)
            ->where('operation', '<>', Operations::Balance)
            ->get();

        return $lastBalance->value +
            $transactions->where('operation', '=', Operations::Credit)->sum('value') -
            $transactions->where('operation', '=', Operations::Debit)->sum('value');
    }

    public function closeBalance(Account $account)
    {
        $transaction = Transaction::create(
            [
                'value' => $this->balance($account),
                'operation' => Operations::Balance
            ]
        );
        dd($account->transactions, $transaction);
        app(TransactionService::class)->add($account, $transaction);
    }
}