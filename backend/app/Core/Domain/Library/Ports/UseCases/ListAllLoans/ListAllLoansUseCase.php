<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllLoans;

use App\Core\Common\Ports\ViewModel;

interface ListAllLoansUseCase
{
    public function execute(): ViewModel;
}
