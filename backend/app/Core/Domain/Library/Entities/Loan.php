<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Common\Traits\{WithCreatedAt, WithUpdatedAt};
use App\Core\Domain\Library\Exceptions\{LoanMustHaveABook, LoanMustHaveAStatus, LoanMustHaveALoanDate, LoanMustHaveADueDate, LoanMustHaveAReturnDate};
use DateTime;

final class Loan extends Entity
{
    use WithCreatedAt, WithUpdatedAt;

    /**
     * @var ?string
     */
    public ?string $id;

    /**
     * @var ?string
     */
    public ?string $bookId;

    /**
     * @var ?Book
     */
    public ?Book $book;

    /**
     * @var ?string
     */
    public ?string $status;

    /**
     * @var DateTime
     */
    public DateTime $loanDate;

    /**
     * @var DateTime
     */
    public DateTime $dueDate;

    /**
     * @var ?DateTime
     */
    public ?DateTime $returnDate;

    /**
     * Loan constructor.
     * @param string|null $id
     * @param string|null $bookId
     * @param DateTime $loanDate
     * @param DateTime $dueDate
     * @param string|null $status
     * @param DateTime|null $returnDate
     * @param DateTime|null $createdAt
     * @param DateTime|null $updatedAt
     */
    public function __construct(
        DateTime $loanDate,
        DateTime $dueDate,
        ?string $id = null,
        ?string $bookId = null,
        ?string $status = null,
        ?DateTime $returnDate = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    ) {
        parent::__construct($id);
        $this->bookId = $bookId;
        $this->loanDate = $loanDate;
        $this->dueDate = $dueDate;
        $this->status = $status;
        $this->returnDate = $returnDate;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;

        $this->validate();
    }

    /**
     * @param Book $book
     * @return void
     */
    public function addBook(Book $book): void
    {
        $this->book = $book;
    }

    /**
     * Validate the loan entity.
     * @return void
     */
    public function validate(): void
    {
        if (empty($this->bookId)) {
            throw new LoanMustHaveABook();
        }

        if (empty($this->loanDate)) {
            throw new LoanMustHaveALoanDate();
        }

        if (empty($this->dueDate)) {
            throw new LoanMustHaveADueDate();
        }

        if (empty($this->status)) {
            throw new LoanMustHaveAStatus();
        }

        if ($this->status === 'returned' && empty($this->returnDate)) {
            throw new LoanMustHaveAReturnDate();
        }
    }

    // Getters
    public function getId(): string
    {
        return $this->id;
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }

    public function getLoanDate(): DateTime
    {
        return $this->loanDate;
    }

    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    public function getReturnDate(): ?DateTime
    {
        return $this->returnDate;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
