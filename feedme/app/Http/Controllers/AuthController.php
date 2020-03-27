<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Customer;
use App\Merchant;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registerCustomer', 'registerMerchant']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }









    public function registerUser($request){
        //todo: validate input

        $user = User::create([
            'firstName' => $request->firstName, //todo: edit migration and seeder (name is now splitted in first and last)
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return $user;
    }



    public function registerMerchant(Request $request){
        $user = $this->registerUser($request);

        $merchantRole = Role::where("name", "merchant")->get();
        $user->roles()->attach($merchantRole);

        //todo: validate input
        $newMerchant = new Merchant();
        $newMerchant->name = $request->merchantName;
        $newMerchant->apiName = $request->merchantApiName; //todo: create this dynamically
        $user->merchant()->save($newMerchant);
    }

    public function registerCustomer(Request $request){
        $user = $this->registerUser($request);

        $customerRole = Role::where("name", "customer")->get();
        $user->roles()->attach($customerRole);

        $user->customer()->save(new Customer());
     }


    
}