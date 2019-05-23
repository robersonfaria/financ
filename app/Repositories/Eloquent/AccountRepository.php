<?php

namespace App\Repositories\Eloquent;


use App\Enums\Operations;
use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryContract;
use App\Repositories\Contracts\TransactionRepositoryContract;
use Carbon\Carbon;

class AccountRepository implements AccountRepositoryContract
{

    /**
     * @var Account
     */
    private $repository;

    public function __construct(Account $repository)
    {
        $this->repository = $repository;
    }

    public function extract($last = true): array
    {
        return $this->repository->transactions->toArray();
    }

    public function closeBalance()
    {
        $lastBalance = $this->balance();

        $balanceValue = $this->repository
            ->where('created_at', '>=', $lastBalance->created_at ?? Carbon::create(1900))
            ->where('operations', '<>', Operations::Balance)
            ->get()
            ->reduce(function ($balance, $transaction) {
                switch ($transaction->operation) {
                    case Operations::Credit:
                        $balance += $transaction->value;
                        break;
                    case Operations::Debit:
                        $balance -= $transaction->value;
                        break;
                }
                return $balance;
            }, $lastBalance->value ?? 0);

        app(TransactionRepository::class)->add($this->repository, Operations::Balance, $balanceValue);
    }

    public function balance()
    {
        return $this->repository->where('operation', Operations::Balance)->latest()->first();
    }
}