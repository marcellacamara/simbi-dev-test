<?php

namespace Database\Seeders;

use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Loan::truncate();
        Loan::factory()->count(5)->create();
    }
}
