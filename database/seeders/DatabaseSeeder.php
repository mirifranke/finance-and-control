<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Miriam',
            'email' => 'miriam.franke77@gmail.com',
            'password' => bcrypt('test'),
        ]);

        User::factory()->create([
            'name' => 'Belve',
            'email' => 'art1san@pm.me',
            'password' => bcrypt('test'),
        ]);
    }
}
