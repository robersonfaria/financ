<?php

namespace Tests\Unit;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\BalanceService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\TransactionService;

class TransactionsTest extends TestCase
{

    use RefreshDatabase;

    public function testInsertCredit()
    {
        $account = factory(Account::class)->create();

        $balance = $account->transactions->sum('value');

        $transaction = factory(Transaction::class)->state('credit')->make();

        app(TransactionService::class)
            ->add($account, $transaction);

        $actualBalance = app(BalanceService::class)->get($account);

        $this->assertEquals($actualBalance, $balance + $transaction->value);
    }

    public function testInsertDebit()
    {
        $account = factory(Account::class)->create();

        $balance = $account->transactions->sum('value');

        $transaction = factory(Transaction::class)->state('debit')->make();

        app(TransactionService::class)
            ->add($account, $transaction);

        $actualBalance = app(BalanceService::class)->get($account);

        $this->assertEquals($actualBalance, $balance - $transaction->value);
    }

    public function testManyTransactions()
    {
        $account = factory(Account::class)->create();

        $balance = $account->transactions->sum('value');

        $credit = factory(Transaction::class)->state('credit')->make();
        $debit = factory(Transaction::class)->state('debit')->make();

        app(TransactionService::class)
            ->add($account, $credit);
        app(TransactionService::class)
            ->add($account, $debit);

        $actualBalance = app(BalanceService::class)->get($account);

        $this->assertEquals($actualBalance, $balance + $credit->value - $debit->value);
    }

    public function testCloseBalance()
    {
        $account = factory(Account::class)->create();

        $balance = app(BalanceService::class)->get($account);

        $credit = factory(Transaction::class)->state('credit')->make();
        $debit = factory(Transaction::class)->state('debit')->make();

        app(TransactionService::class)
            ->add($account, $credit);
        app(TransactionService::class)
            ->add($account, $debit);

        $finalBalance = app(BalanceService::class)->close($account);

        $this->assertEquals($balance + $credit->value - $debit->value, $finalBalance->value);
    }
}
