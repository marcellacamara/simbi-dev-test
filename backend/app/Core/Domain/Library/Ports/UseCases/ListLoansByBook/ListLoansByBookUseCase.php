<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListLoansByBook;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\ListLoansByBook\ListLoansByBookRequestModel;

interface ListLoansByBookUseCase
{
    public function execute(ListLoansByBookRequestModel $requestModel): ViewModel;
}
