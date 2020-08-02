<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = DB::table('user_roles')->get();
        if ($roles->count() === 0) {
            DB::table('user_roles')->insert([
                ['id' => 1, 'name' => 'Medical representative'],
                ['id' => 2, 'name' => 'First line manager'],
                ['id' => 3, 'name' => 'Second line manager'],
                ['id' => 4, 'name' => 'HR'],
                ['id' => 5, 'name' => 'Top management'],
                ['id' => 6, 'name' => 'Trainer'],
            ]);
        }
    }
}
