<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Miriam',
            'email' => 'miriam.franke77@gmail.com',
            'password' => bcrypt('test'),
        ]);

        $this->call([
            SqlFileSeeder::class
        ]);
    }
}
