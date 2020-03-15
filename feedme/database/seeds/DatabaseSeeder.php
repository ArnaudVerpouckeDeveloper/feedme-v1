<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Order;
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
            for ($i = 0; $i <= 2; $i++)
            {
                $order = new Order();
                $order->firstName = $faker->firstName();
                $order->lastName = $faker->lastName();
                $order->addressStreet = $faker->streetName();
                $order->addressNumber = $faker->numberBetween(1,300);
                $order->addressZipCode = $faker->numberBetween(1000,9000);
                $order->addressCity = $faker->city();
                $order->telephoneNumber = $faker->phoneNumber();
                $order->email = $faker->email();
                $order->details = $faker->realText(100);
                $order->deliveryOn = date("Y-m-d H:i:s", strtotime("+1 hours"));
                $order->confirmed = false;

                $user->orders()->save($order);

                $productsInStock = Product::all();
                for ($j = 0; $j <= 2; $j++){
                    $order->products()->attach($productsInStock[$j]); //milat hier probleem
                }



            }
        }

        
        
    }
    
}
