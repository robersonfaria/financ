<?php

namespace Tests\Unit;

use App\Enums\Operations;
use App\Models\Account;
use App\Repositories\Eloquent\AccountRepository;
use App\Repositories\Eloquent\TransactionRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionsTest extends TestCase
{

    use RefreshDatabase;

    public function testInsertCredit()
    {
        $account = factory(Account::class)->create();

        $transactionRepository = app(TransactionRepository::class);

        $transactionRepository->add($account, Operations::Credit, 100)
            ->consolidate();

        $transactionRepository->add($account, Operations::Credit, 150);

        $extract = collect((new AccountRepository($account))->extract());

        $this->assertEquals($extract->sum("value"), 250);

        $this->assertEquals($extract->where('consolidated', true)->sum("value"), 100);
    }

    public function testBalance()
    {
        $account = factory(Account::class)->create();

        $transactionRepository = app(TransactionRepository::class);

        $transactionRepository->add($account, Operations::Credit, 100)
            ->consolidate();

        $transactionRepository->add($account, Operations::Credit, 150);

        $accountRepository = new AccountRepository($account);

        $accountRepository->closeBalance();

        $this->assertEquals($accountRepository->balance()->value, 250);
    }
}
