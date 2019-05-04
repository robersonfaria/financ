<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccountType extends Enum
{
    const CheckingAccount = 'CA';
    const CreditCard = 'CC';
}
