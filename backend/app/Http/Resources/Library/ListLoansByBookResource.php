<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ListLoansByBookResource extends JsonResource
{
    /**
     * @param Loan $loan
     */
    public function __construct(private Loan $loan) {}
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
        return [
            'id' => $this->loan->id,
            'bookId' => $this->loan->bookId,
            'loanDate' => $this->loan->loanDate,
            'dueDate' => $this->loan->dueDate,
            'returnDate' => $this->loan->returnDate,
            'status' => $this->loan->status,
            'book' => (new BookDetailsResource($this->loan->book))->resolve(),
            'createdAt' => $this->loan->createdAt->format(DateTime::ATOM),
            'updatedAt' => $this->loan->updatedAt->format(DateTime::ATOM),
        ];
    }
}
