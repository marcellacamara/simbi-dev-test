<?php

namespace Tests\Unit;

use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Exceptions\LoanMustHaveAStatus;
use PHPUnit\Framework\TestCase;

class LoanTest extends TestCase
{
    public function testShouldBeAbleToInstantiateALoan()
    {
        $loan = new Loan(
            id: 'loan-uuid',
            bookId: 'book-uuid',
            loanDate: new \DateTime('now'),
            dueDate: new \DateTime('+30 days'),
            returnDate: null,
            status: 'active'
        );

        // Verificação das propriedades
        $this->assertEquals('loan-uuid', $loan->getId());
        $this->assertEquals('book-uuid', $loan->getBookId());
        $this->assertInstanceOf(\DateTime::class, $loan->getLoanDate());
        $this->assertEquals('active', $loan->getStatus());
        $this->assertNull($loan->getReturnDate());
    }

    public function testShouldCreateLoan()
    {
        $loan = new Loan(
            id: 'loan-uuid',
            bookId: 'book-uuid',
            loanDate: new \DateTime('now'),
            dueDate: new \DateTime('+30 days'),
            returnDate: null,
            status: 'active'
        );

        $this->assertEquals('loan-uuid', $loan->getId());
        $this->assertEquals('book-uuid', $loan->getBookId());
        $this->assertEquals('active', $loan->getStatus());
    }

    public function testShouldThrowExceptionWhenNoBookId()
    {
        $this->expectException(LoanMustHaveABook::class);

        new Loan(
            id: 'loan-uuid',
            bookId: null, // bookId inválido
            loanDate: new \DateTime('now'),
            dueDate: new \DateTime('+30 days'),
            returnDate: null,
            status: 'active'
        );
    }

    public function testShouldThrowExceptionWhenNoStatus()
    {
        $this->expectException(LoanMustHaveAStatus::class);

        new Loan(
            id: 'loan-uuid',
            bookId: 'book-uuid',
            loanDate: new \DateTime('now'),
            dueDate: new \DateTime('+30 days'),
            returnDate: null,
            status: null // Status inválido
        );
    }

    public function testShouldSetReturnDate()
    {
        $loan = new Loan(
            id: 'loan-uuid',
            bookId: 'book-uuid',
            loanDate: new \DateTime('now'),
            dueDate: new \DateTime('+30 days'),
            returnDate: new \DateTime('+15 days'),
            status: 'returned'
        );

        $this->assertEquals(
            (new \DateTime('+15 days'))->format('Y-m-d'),
            $loan->getReturnDate()->format('Y-m-d')
        );
    }
}
