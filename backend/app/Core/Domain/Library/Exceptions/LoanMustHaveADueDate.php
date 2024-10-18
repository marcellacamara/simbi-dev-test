<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveADueDate extends DomainException
{
    protected $message = 'Loan must have a due date.';
}
