<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\ListLoansByBook\ListLoansByBookRequestModel;
use App\Core\Domain\Library\Ports\UseCases\ListLoansByBook\ListLoansByBookUseCase;
use App\Http\Requests\ListLoanByBookRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListLoansByBookController extends Controller
{
    /**
     * @param ListLoansByBookUseCase $useCase
     */
    public function __construct(private ListLoansByBookUseCase $useCase) {}

    /**
     * Lista todos os empréstimos cadastrados.
     *
     *  @OA\Get(
     *     path="/api/books/{id}/loans",
     *     summary="Lista todos os empréstimos cadastrados por um determinado livro",
     *     tags={"Loans"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         schema={"type": "string"},
     *         required=true,
     *         description="ID do livro",
     *         example="1234567890"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Loans list",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="string", example="1234567890"),
     *                 @OA\Property(property="bookId", type="string", example="1234567890"),
     *                 @OA\Property(property="loanDate", type="string", format="date", example="2024-10-17"),
     *                 @OA\Property(property="dueDate", type="string", format="date", example="2024-10-24"),
     *                 @OA\Property(property="status", type="string", example="Pending")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Requisição com erro"),
     *     @OA\Response(response=401, description="Proibido"),
     *     @OA\Response(response=403, description="Não autorizado"),
     *     @OA\Response(response=500, description="Erro interno")
     * ),
     *
     * @param  ListLoanByBookRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(ListLoanByBookRequest $request)
    {
        $viewModel = $this->useCase->execute(new ListLoansByBookRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_OK);
    }
}
