<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Order;
use App\Role;
use App\Merchant;
use App\Customer;
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


        DB::table('roles')->insert(['name' => 'merchant']);
        DB::table('roles')->insert(['name' => 'customer']);
        $merchantRole = Role::where("name", "merchant")->get();
        $customerRole = Role::where("name", "customer")->get();


        $merchant1 = User::create([
            'name' => 'Arnaud Verpoucke',
            'email' => 'arnaud@test.com',
            'password' => bcrypt('123'),
        ]);
        $merchant1->roles()->attach($merchantRole);
        $merchant1->merchant()->save(new Merchant());

        $merchant2 = User::create([
            'name' => 'Milat Qais',
            'email' => 'malat@test.com',
            'password' => bcrypt('123'),
        ]);
        $merchant2->roles()->attach($merchantRole);
        $merchant2->merchant()->save(new Merchant());


        $customer1 = User::create([
            'name' => 'emma',
            'email' => 'emma@test.com',
            'password' => bcrypt('123'),
        ]);
        $customer1->roles()->attach($customerRole);
        $customer1->customer()->save(new Customer());


        $customer2 = User::create([
            'name' => 'Bart',
            'email' => 'bart@test.com',
            'password' => bcrypt('123'),
        ]);
        $customer2->roles()->attach($customerRole);
        $customer2->customer()->save(new Customer());


        $allUsers = User::all();
        $merchantUsers = [];
        $customerUsers = [];

        foreach($allUsers as $user){
            if ($user->hasAnyRole("merchant")){
                array_push($merchantUsers, $user);
            }
            if ($user->hasAnyRole("customer")){
                array_push($customerUsers, $user);
            }
        }



        foreach ($merchantUsers as $user) {
            
            for ($i = 0; $i <= 6; $i++)
            {
                $product = new Product();
                $product->name = "test";
                $product->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 30);
                $product->available = true;


                
                $user->merchant->products()->save($product);
            }
            
            
            for ($i = 0; $i <= 2; $i++)
            {
                $order = new Order();

                /*
                $order->firstName = $faker->firstName();
                $order->lastName = $faker->lastName();
                $order->telephoneNumber = $faker->phoneNumber();
                $order->email = $faker->email();
                */

                $order->addressStreet = $faker->streetName();
                $order->addressNumber = $faker->numberBetween(1,300);
                $order->addressZipCode = $faker->numberBetween(1000,9000);
                $order->addressCity = $faker->city();
                $order->deliveryMethod = "delivery";

                

                $order->details = $faker->realText(100);
                $order->deliveryOn = date("Y-m-d H:i:s", strtotime("+1 hours"));
                $order->confirmed = false;
                

                $user->merchant->orders()->save($order);
                $customer1->customer->orders()->save($order);


                $productsInStock = Product::all();
                for ($j = 0; $j <= 2; $j++){
                    $order->products()->attach($productsInStock[$j]);
                }
            }
            
        }

        
        
    }
    
}
