<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
//use Faker\Generator as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

     
    public function run()
    {
        $faker = Faker\Factory::create();

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




        $users = User::all();
        foreach ($users as $user) {
            for ($i = 0; $i <= 6; $i++)
            {
                $product = new Product();
                //$product->name = $faker->sentence($nbWords = 3, $variableNbWords = true);
                $product->name = "test";
                $product->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 30);
                $product->available = true;
                $user->products()->save($product);
            }
        }
        
    }
    
}
