<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = DB::table('programs')->get();
        if ($statuses->count() === 0) {
            DB::table('programs')->insert([
                ['id' => 1, 'name' => '3abkarino'],
                ['id' => 2, 'name' => 'Globe Champion'],
                ['id' => 3, 'name' => 'Globe Idol'],
                ['id' => 4, 'name' => 'Selm El-Magd'],
                ['id' => 5, 'name' => 'El-Da7ee7'],
                ['id' => 6, 'name' => 'Talent Catching'],
                ['id' => 7, 'name' => 'Globe Olympics'],
                ['id' => 8, 'name' => 'General'],
            ]);
        }
    }
}
