<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListLoansByBook;

use App\Core\Common\Ports\ViewModel;

interface ListLoansByBookOutputPort
{
    /**
     * @param ListLoansByBookResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListLoansByBookResponseModel $responseModel): ViewModel;
}
