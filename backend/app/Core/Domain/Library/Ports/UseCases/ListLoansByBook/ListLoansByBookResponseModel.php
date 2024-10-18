<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListLoansByBook;

use App\Core\Domain\Library\Entities\Loan;

final class ListLoansByBookResponseModel
{
    /**
     * @param array<Loan> $loans
     */
    public function __construct(private array $loans) {}

    /**
     * @return array<Loan>
     */
    public function getBooks(): array
    {
        return $this->loans;
    }
}
