<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Loan as DomainLoan;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\LoanMapper;
use DateTime;

final class LoanEloquentRepository implements LoanRepository
{
    /**
     * @param DomainLoan $loan
     *
     * @return DomainLoan
     */
    public function create(DomainLoan $loan): DomainLoan
    {
        $eloquentLoan = LoanMapper::toEloquentEntity($loan);
        $eloquentLoan->save();

        return $loan;
    }

    /**
     * @return array<Loan>
     */
    public function getAll(): array
    {
        $loans = EloquentLoan::with(['book'])
            ->get()
            ->all();

        if (empty($loans)) {
            return [];
        }

        return LoanMapper::toManyDomainEntities($loans);
    }

    /**
     * @param string $authorId
     *
     * @return array<Book>
     */
    public function getLoansByBookId(string $bookId): array
    {
        $eloquentLoans = EloquentLoan::where(['book_id' => $bookId])
            ->with(['book'])
            ->get()
            ->all();

        if (empty($eloquentLoans)) {
            return [];
        }

        return LoanMapper::toManyDomainEntities($eloquentLoans);
    }
}
