<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllLoans;

use App\Core\Common\Ports\ViewModel;

interface ListAllLoansOutputPort
{
    /**
     * @param ListAllLoansResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListAllLoansResponseModel $responseModel): ViewModel;
}
