<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = DB::table('user_statuses')->get();
        if ($statuses->count() === 0) {
            DB::table('user_statuses')->insert([
                ['id' => 1, 'name' => 'Active'],
                ['id' => 2, 'name' => 'Pinding'],
                ['id' => 3, 'name' => 'In Active'],
            ]);
        }
    }
}
