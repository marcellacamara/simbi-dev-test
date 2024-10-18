<?php

namespace Tests\Integration\Library;

use App\Adapters\Presenters\Library\CreateLoanJsonPresenter;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanRequestModel;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\CreateLoanUseCase;
use App\Core\Services\Library\CreateLoanService;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use App\Infra\Adapters\Persistence\Eloquent\Repositories\LoanEloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateLoanUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CreateLoanUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = new CreateLoanService(
            output: new CreateLoanJsonPresenter(),
            loanRepository: new LoanEloquentRepository(),
        );
    }

    public function testShouldCreateLoan()
    {
        $book = Book::factory()->create(); // Criar um livro válido

        $request = new CreateLoanRequestModel([
            'bookId' => $book->id,
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertIsString($loan['id']);
        $this->assertEquals($book->id, $loan['bookId']);
    }

    public function testShouldThrowInvalidBook()
    {
        $request = new CreateLoanRequestModel([
            'bookId' => null, // Livro inválido
        ]);

        $this->expectException(LoanMustHaveABook::class);
        $this->useCase->execute($request);
    }

    public function testShouldLinkLoanToBook()
    {
        $book = Book::factory()->create(); // Criar um livro válido
        $request = new CreateLoanRequestModel([
            'bookId' => $book->id,
        ]);

        $loan = $this->useCase->execute($request)->resource->toArray(null);

        $this->assertEquals($book->id, $loan['bookId']);
    }
}
