<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{
    CreateLoanOutputPort,
    CreateLoanRequestModel,
    CreateLoanResponseModel,
    CreateLoanUseCase,
};
use DateTime;

final class CreateLoanService implements CreateLoanUseCase
{
    /**
     * @param CreateLoanOutputPort $output
     */
    public function __construct(private CreateLoanOutputPort $output, private LoanRepository $loanRepository) {}

    /**
     * @param CreateLoanRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(CreateLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $loanDate = $requestModel->getLoanDate();
        $dueDate = $requestModel->getDueDate();
        $returnDate = $requestModel->getReturnDate();

        $loan = $this->loanRepository->create(
            new Loan(
                $loanDate,
                $dueDate,
                $requestModel->getBookId(),
                $requestModel->getStatus(),
                $returnDate,
            )
        );

        return $this->output->present(new CreateLoanResponseModel($loan));
    }

    /**
     * @param CreateLoanRequestModel $requestModel
     *
     * @return void
     */
    private function validate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getBookId())) {
            throw new LoanMustHaveABook();
        }
    }
}
