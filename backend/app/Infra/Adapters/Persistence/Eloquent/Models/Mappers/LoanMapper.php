<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models\Mappers;

use App\Core\Domain\Library\Entities\Loan as DomainLoan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;

final class LoanMapper
{
    /**
     * @param EloquentLoan $loan
     * @param bool $withRelations
     *
     * @return DomainLoan
     */
    public static function toDomainEntity(EloquentLoan $loan, bool $withRelations = true): DomainLoan
    {
        $domainLoan = new DomainLoan(
            id: $loan->id,
            bookId: $loan->book_id,
            loanDate: $loan->loan_date,
            dueDate: $loan->due_date,
            returnDate: $loan->return_date,
            status: $loan->status,
            createdAt: $loan->created_at,
            updatedAt: $loan->updated_at,
        );

        if ($withRelations && ! empty($loan->book)) {
            $domainLoan->addBook(BookMapper::toDomainEntity($loan->book));
        }

        return $domainLoan;
    }

    /**
     * @param array<EloquentLoan> $loans
     *
     * @return array<DomainLoan>
     */
    public static function toManyDomainEntities(array $loans): array
    {
        return array_map(static fn($loan) => self::toDomainEntity($loan), $loans);
    }

    public static function toEloquentEntity(DomainLoan $loan): EloquentLoan
    {
        $eloquentLoan = new EloquentLoan([
            'id' => $loan->id,
            'book_id' => $loan->bookId,
            'loan_date' => $loan->loanDate,
            'due_date' => $loan->dueDate,
            'return_date' => $loan->returnDate,
            'status' => $loan->status,
        ]);

        return $eloquentLoan;
    }
}
