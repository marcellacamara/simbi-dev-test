<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

use App\Core\Domain\Library\Entities\Loan;

final class CreateLoanResponseModel
{
    /**
     * @param Loan $loan
     */
    public function __construct(private Loan $loan) {}

    /**
     * @return Loan
     */
    public function getLoan(): Loan
    {
        return $this->loan;
    }
}
