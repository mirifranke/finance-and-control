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

        Category::factory()->count(5)->create();

        Payment::factory()
            ->count(30)
            ->create();
    }
}
