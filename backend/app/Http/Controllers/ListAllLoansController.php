<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\ListAllLoans\ListAllLoansUseCase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListAllLoansController extends Controller
{
    /**
     * @param ListAllLoansUseCase $useCase
     */
    public function __construct(private ListAllLoansUseCase $useCase) {}

    /**
     * Lista todos os empréstimos cadastrados.
     *
     * @OA\Get(
     *     path="/api/loans",
     *     summary="Lista todos os empréstimos cadastrados na API",
     *     tags={"Loans"},
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
     * @param  ListAllLoansUseCase  $request
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        $viewModel = $this->useCase->execute();
        return response()->json($viewModel->getResponse(), Response::HTTP_OK);
    }
}
