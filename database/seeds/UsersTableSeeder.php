<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        if ($users->count() === 0) {
            DB::table('users')->insert([
                ['id' => 1, 'name' => 'Ramsis', 'email' => 'ramsis@company.com', 'is_admin' => true, 'status_id' => 1, 'password' => Hash::make('dummy123'), 'email_verified_at' => '2020-06-26 13:03:21'],
            ]);
        }
    }
}
