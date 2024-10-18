<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveALoanDate extends DomainException
{
    protected $message = 'Loan must have a loan date.';
}
