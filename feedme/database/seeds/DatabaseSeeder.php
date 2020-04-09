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
            'firstName' => 'Arnaud',
            'lastName' => 'Verpoucke',
            'email' => 'arnaud@test.com',
            'password' => bcrypt('123'),
            'verificationCode' => Str::random(128),
            'email_verified_at' => now(),
            'mobilePhone' => "0479456321"
        ]);
        $merchant1->roles()->attach($merchantRole);
        $newMerchant = new Merchant();
        $newMerchant->name = "Arnaud's restaurant";
        $newMerchant->apiName = "arnaudsrestaurant";
        $newMerchant->merchantPhone = "0470123456";
        $newMerchant->address_street = $faker->streetName();
        $newMerchant->address_number = $faker->buildingNumber;
        $newMerchant->address_zip = 8800;
        $newMerchant->address_city = $faker->city();
        $newMerchant->tax_number = "BE 1234.567.890";
        $merchant1->merchant()->save($newMerchant);




        /* updating does not work
        $merchant1->merchant()->deliveryMethod_delivery = true;
        $merchant1->merchant()->deliveryMethod_takeaway = true;
        $merchant1->merchant()->update(['deliveryMethod_delivery' => $true]);
        $merchant1->merchant()->update(['deliveryMethod_takeaway' => $true]);
        */

        $merchant2 = User::create([
            'firstName' => 'Milat',
            'lastName' => 'Qais',
            'email' => 'malat@test.com',
            'password' => bcrypt('123'),
            'verificationCode' => Str::random(128),
            'mobilePhone' => "0479456321"
        ]);
        $merchant2->roles()->attach($merchantRole);
        $newMerchant = new Merchant();
        $newMerchant->name = "Qais & fresh";
        $newMerchant->apiName = "qaisandfresh";
        $newMerchant->merchantPhone = "0470123456";
        $newMerchant->address_street = $faker->streetName();
        $newMerchant->address_number = $faker->buildingNumber;
        $newMerchant->address_zip = 8800;
        $newMerchant->address_city = $faker->city();
        $newMerchant->tax_number = "BE 1234.567.890";

        $merchant2->merchant()->save($newMerchant);
        
        //$merchant2->merchant()->deliveryMethod_delivery = true;
        //$merchant2->merchant()->deliveryMethod_takeaway = true;

        $customer1 = User::create([
            'firstName' => 'Emma',
            'lastName' => 'De Smedt',
            'email' => 'emma@test.com',
            'password' => bcrypt('123'),
            'verificationCode' => Str::random(128),
            'mobilePhone' => "0479456321"
        ]);
        $customer1->roles()->attach($customerRole);
        $customer1->customer()->save(new Customer());


        $customer2 = User::create([
            'firstName' => 'Bart',
            'lastName' => 'Geesens',
            'email' => 'bart@test.com',
            'password' => bcrypt('123'),
            'verificationCode' => Str::random(128),
            'mobilePhone' => "0479456321"
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
                $product->name = $faker->catchPhrase();
                $product->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 30);
               
                $user->merchant->products()->save($product);
            }
            
            
            for ($i = 0; $i <= 8; $i++)
            {
                $order = new Order();

                /*
                $order->firstName = $faker->firstName();
                $order->lastName = $faker->lastName();
                $order->telephoneNumber = $faker->phoneNumber();
                $order->email = $faker->email();
                */

                $randomValue = rand(0,1);
                if ($randomValue == 1){
                    $order->deliveryMethod = "delivery";
                    $order->addressStreet = $faker->streetName();
                    $order->addressNumber = $faker->numberBetween(1,300);
                    $order->addressZipCode = $faker->numberBetween(1000,9000);
                    $order->addressCity = $faker->city();
                }
                else{
                    $order->deliveryMethod = "takeaway";
                }

                
                

                if (rand(0,1) == 1){
                    $order->details = $faker->realText(100);
                }
                $extraHours = random_int(0,3);
                $extraMinutes = random_int(0,60);
                $order->requestedTime = date("Y-m-d H:i:s", strtotime("+$extraHours hour +$extraMinutes minutes"));
                

                $user->merchant->orders()->save($order);
                $customer1->customer->orders()->save($order);


                $productsInStock = Product::all();
                $totalPrice = 0;
                for ($j = rand(0,3); $j <= rand(3,4); $j++){
                    $order->products()->attach($productsInStock[$j]);
                    $totalPrice = $totalPrice + $productsInStock[$j]->price;
                }

                $order->totalPrice = $totalPrice;
                $order->save();


                
                $order->products()->attach($productsInStock[0]);
                $order->products()->attach($productsInStock[2]);
                
            }
            
        }

        
        
    }
    
}
