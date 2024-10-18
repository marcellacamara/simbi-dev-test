<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{CreateLoanOutputPort, CreateLoanResponseModel};
use App\Http\Resources\Library\CreateLoanResource;

final class CreateLoanJsonPresenter implements CreateLoanOutputPort
{
    /**
     * @param CreateLoanResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(CreateLoanResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new CreateLoanResource($responseModel->getLoan()));
    }
}
