<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListLoansByBook;

final class ListLoansByBookRequestModel
{
    private string $bookId;

    /**
     * @param array $attributes
     */
    public function __construct(private array $attributes = [])
    {
        $this->bookId = $attributes['bookId'] ?? '';
    }

    /**
     * @return string
     */
    public function getBookId(): string
    {
        return $this->bookId;
    }
}
