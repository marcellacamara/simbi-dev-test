<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveAStatus extends DomainException
{
    protected $message = 'Loan must have a status.';
}
