<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Loan;

interface LoanRepository
{
    /**
     * @param Loan $loan
     *
     * @return Loan
     */
    public function create(Loan $loan): Loan;

    /**
     * @return array<Loan>;
     */
    public function getAll(): array;

    /**
     * @param string $authorId
     *
     * @return array<Loan>;
     */
    public function getLoansByBookId(string $bookId): array;
}
