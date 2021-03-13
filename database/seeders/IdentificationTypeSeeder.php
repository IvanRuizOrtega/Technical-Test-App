<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\IdentificationType;

class IdentificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $identificationType_ = IdentificationType::create(
            [
                'name' => 'Cédula de ciudadania',
            ]
        );
    }
}
