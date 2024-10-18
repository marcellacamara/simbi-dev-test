<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{CreateLoanRequestModel, CreateLoanUseCase};
use App\Http\Requests\CreateLoanRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateLoanController extends Controller
{
    /**
     * @param CreateLoanUseCase $useCase
     */
    public function __construct(private CreateLoanUseCase $useCase) {}

    /**
     * Permite adicionar um novo empréstimo
     *
     *@OA\Post(
     *     path="/api/loans",
     *     summary="Cria um novo empréstimo na API",
     *     tags={"Loans"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"bookId", "loanDate", "dueDate"},
     *             @OA\Property(property="bookId", type="string", example="1234567890"),
     *             @OA\Property(property="loanDate", type="string", format="date", example="2024-10-17"),
     *             @OA\Property(property="dueDate", type="string", format="date", example="2024-10-24"),
     *             @OA\Property(property="returnDate", type="string", format="date", example="2024-10-20"),
     *             @OA\Property(property="status", type="string", example="Pending")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Loan Created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="string", example="1234567890"),
     *             @OA\Property(property="bookId", type="string", example="1234567890"),
     *             @OA\Property(property="loanDate", type="string", format="date", example="2024-10-17"),
     *             @OA\Property(property="dueDate", type="string", format="date", example="2024-10-24"),
     *             @OA\Property(property="status", type="string", example="Pending")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Requisição com erro"),
     *     @OA\Response(response=401, description="Proibido"),
     *     @OA\Response(response=403, description="Não autorizado"),
     *     @OA\Response(response=500, description="Erro interno")
     * ),
     *
     * @param  CreateLoanRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(CreateLoanRequest $request)
    {
        $viewModel = $this->useCase->execute(new CreateLoanRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_CREATED);
    }
}
