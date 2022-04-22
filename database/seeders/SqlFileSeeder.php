<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqlFileSeeder extends Seeder
{
    public function run()
    {
        $path = public_path('/sql/categories.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        $path = public_path('/sql/payments.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
