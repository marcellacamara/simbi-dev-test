<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveAReturnDate extends DomainException
{
    protected $message = 'Loan must have a return date.';
}
