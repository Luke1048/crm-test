<?php

declare(strict_types=1);

namespace Database\Seeders\Customer;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $count = 50;

        for ($i = 0; $i < $count; $i++) {
            DB::transaction(
                fn() => retry(
                    5,
                    fn() => Customer::factory()->create(),
                    100
                )
            );
        }
    }
}
