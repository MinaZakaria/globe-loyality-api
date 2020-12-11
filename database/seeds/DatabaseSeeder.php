<?php

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
        $this->call([
            ProgramsTableSeeder::class,
            UserRolesTableSeeder::class,
            UserStatusesTableSeeder::class,
            UsersTableSeeder::class,
            SubmittionStatusesTableSeeder::class,
        ]);
    }
}
