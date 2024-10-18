<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\ListLoansByBook\{ListLoansByBookOutputPort, ListLoansByBookResponseModel};
use App\Http\Resources\Library\ListLoansByBookResource;

final class ListLoansByBookJsonPresenter implements ListLoansByBookOutputPort
{
    /**
     * @param ListLoansByBookResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListLoansByBookResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(ListLoansByBookResource::collection($responseModel->getBooks()));
    }
}
