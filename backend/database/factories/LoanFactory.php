<?php

namespace Database\Factories;

use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infra\Adapters\Persistence\Eloquent\Models\Loan>
 */
class LoanFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book = Book::inRandomOrder()->first();
        $status = $this->faker->randomElement(['active', 'returned', 'overdue']);
        $loanDate = $this->faker->dateTimeBetween('-1 months', 'now');
        $dueDate = (clone $loanDate)->modify('+30 days');
        $returnDate = $status === 'returned' ? (clone $loanDate)->modify('+20 days') : null;

        return [
            "id" => $this->faker->uuid(),
            "book_id" => $book->id,
            "loan_date" => $loanDate,
            "due_date" => $dueDate,
            "return_date" => $returnDate,
            "status" => $status,
        ];
    }
}
