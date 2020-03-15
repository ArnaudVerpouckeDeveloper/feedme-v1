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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Arnaud Verpoucke',
            'email' => 'arnaud@test.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Milat Qais',
            'email' => 'malat@test.com',
            'password' => bcrypt('123'),
        ]);
    }
}
