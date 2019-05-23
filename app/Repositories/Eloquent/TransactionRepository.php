<?php

namespace App\Repositories\Eloquent;


use App\Enums\Operations;
use App\Exceptions\InvalidOperationException;
use App\Models\Account;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryContract;

class TransactionRepository implements TransactionRepositoryContract
{

    /**
     * @var Transaction
     */
    private $repository;

    /**
     * TransactionRepository constructor.
     * @param Transaction $repository
     */
    public function __construct(Transaction $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Account $account
     * @param string $operation
     * @param float $value
     * @return TransactionRepositoryContract
     * @throws InvalidOperationException
     */
    public function add(Account $account, string $operation, float $value, $consolidated = false): TransactionRepositoryContract
    {
        if (!Operations::hasValue($operation)) {
            throw new InvalidOperationException(__("Invalid Operation."));
        }

        $this->repository = $account->transactions()->create([
            "operation" => $operation,
            "value" => $value,
            "consolidated" => $consolidated
        ]);

        return $this;
    }

    public function consolidate()
    {
        $this->repository->update(['consolidated' => true]);
        
        return $this;
    }
}
