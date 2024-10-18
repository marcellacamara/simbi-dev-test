<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

use App\Core\Common\Ports\ViewModel;

interface CreateLoanUseCase
{
    public function execute(CreateLoanRequestModel $requestModel): ViewModel;
}
