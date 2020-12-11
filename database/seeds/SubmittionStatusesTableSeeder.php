<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmittionStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = DB::table('submittion_statuses')->get();
        if ($statuses->count() === 0) {
            DB::table('submittion_statuses')->insert([
                ['id' => 1, 'name' => 'New'],
                ['id' => 2, 'name' => 'Approved'],
                ['id' => 3, 'name' => 'Rejected'],
                ['id' => 4, 'name' => 'Declined'],
            ]);
        }
    }
}
