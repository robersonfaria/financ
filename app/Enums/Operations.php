<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Operations extends Enum
{
    const Debit = 'D';
    const Credit = 'C';
    const Balance = 'B';
}
