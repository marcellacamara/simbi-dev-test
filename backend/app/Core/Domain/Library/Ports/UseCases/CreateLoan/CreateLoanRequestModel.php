<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

use DateTime;

final class CreateLoanRequestModel
{
    /**
     * @param array $attributes
     */
    public function __construct(private array $attributes = []) {}

    public function getBookId(): ?string
    {
        return $this->attributes['book_id'] ?? null;
    }

    public function getLoanDate(): ?DateTime
    {
        return isset($this->attributes['loan_date']) ? new DateTime($this->attributes['loan_date']) : null;
    }

    public function getDueDate(): ?DateTime
    {
        return isset($this->attributes['due_date']) ? new DateTime($this->attributes['due_date']) : null;
    }

    public function getReturnDate(): ?DateTime
    {
        return isset($this->attributes['return_date']) ? new DateTime($this->attributes['return_date']) : null;
    }

    public function getStatus(): ?string
    {
        return $this->attributes['status'] ?? null;
    }
}
