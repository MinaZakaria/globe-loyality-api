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
                ['id' => 1, 'name' => 'xx'],
                ['id' => 2, 'name' => 'yy'],
            ]);
        }
    }
}
