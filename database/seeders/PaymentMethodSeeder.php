<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        PaymentMethod::create([
            'title' => 'Bancolombia',
            'status' => 1,
        ]);

        PaymentMethod::create([
            'title' => 'Daviplata',
            'status' => 1,
        ]);

        PaymentMethod::create([
            'title' => 'Efectivo',
            'status' => 1,
        ]);

        PaymentMethod::create([
            'title' => 'Nequi',
            'status' => 1,
        ]);

        PaymentMethod::create([
            'title' => 'PSE',
            'status' => 1,
        ]);
    }
}
