<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\IdentificationType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $identificationType_ = IdentificationType::firstWhere('name', 'Cédula de ciudadania');

        $user_ = User::create(
            [
                'name'                   => 'Ivan Ruiz Ortega',
                'email'                  => 'test@test.com',
                'password'               => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'identification'         => '110234345400',
                'email_verified_at'      => now(),
                'identification_type_id' => $identificationType_->id
            ]
        );

    }
}
