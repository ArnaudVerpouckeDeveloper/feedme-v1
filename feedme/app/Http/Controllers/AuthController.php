<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Customer;
use App\Merchant;
use Illuminate\Support\Facades\Validator;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;
use Str;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['verifyEmailNotice','logMerchantIn','login', 'registerCustomer', 'registerMerchant', 'previewApiNameFromMerchantName', 'confirmEmail']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (auth()->user()->hasAnyRole("merchant")){
            return response()->json(['role' => 'merchant']);

            //return redirect()->route('merchant-login', ['email' => $request->email, 'password' => $request->password]);



            //return response()->json(['redirect' => 'http://127.0.0.1:8000/manager/login']);
            //return redirect("/manager/login")->with('email', $request->email)->with('password', $request->password);
        }

        return $this->respondWithToken($token);
    }




    
    function verifyEmailNotice(){
        return back()->withError("Om aan te melden dient u eerst nog uw e-mailadres te bevestigen.");
    }





    public function logMerchantIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);

        if (auth()->attempt($credentials)){
            if(!auth()->user()->hasAnyRole("merchant")){
                return back()->withError('Het account is niet gekoppeld aan een horecazaak.');
            }
            return redirect("/manager/dashboard");
        }
        else{
            return back()->withError('Het opgegeven wachtwoord of e-mailadres is niet correct, probeer opnieuw.');
        }

        /*
        if (auth()->attempt($credentials)) {
            
            $errors = new MessageBag(['password' => ['Email and/or password invalid.']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.

            return Redirect::back()->withErrors($errors)->withInput(Input::except('password')); // redirect back to the login page, using ->withErrors($errors) you send the error created above
            
        }
        */

        if (auth()->user()->hasAnyRole("merchant")){
            return response()->json(['role' => 'merchant']);

            //return redirect()->route('merchant-login', ['email' => $request->email, 'password' => $request->password]);



            //return response()->json(['redirect' => 'http://127.0.0.1:8000/manager/login']);
            //return redirect("/manager/login")->with('email', $request->email)->with('password', $request->password);
        }

        return $this->respondWithToken($token);
    }
    






    public function registerMerchant(Request $request)
    {
        $request->validate([
            'merchantName' => "required|min:1",
            'mobilePhone' => "required",
            'address_street' => "required",
            'address_number' => "required",
            'address_zip' => "required",
            'address_city' => "required",
            'tax_number' => "required",
            ]);

        $user = $this->registerUser($request);
        $merchantRole = Role::where("name", "merchant")->get();
        $user->roles()->attach($merchantRole);

        //todo: validate input
        $newMerchant = new Merchant();
        $newMerchant->name = $request->merchantName;
        $newMerchant->apiName = $this->generateApiNameFromMerchantName($request->merchantName);
        $newMerchant->mobilePhone = $request->mobilePhone;
        $newMerchant->address_street = $request->address_street;
        $newMerchant->address_number = $request->address_number;
        $newMerchant->address_zip = $request->address_zip;
        $newMerchant->address_city = $request->address_city;
        $newMerchant->tax_number = $request->tax_number;
        $user->merchant()->save($newMerchant);

        return view("postRegistration");
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
            'expires_in' => auth()->factory()->getTTL() * 60 * 3
        ]);
    }









    public function registerUser($request){
        $validatedData = $request->validate([
            'firstName' => 'required|min:1|string',
            'lastName' => 'required|min:1|string',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => ['required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_!$#%]).+$/', 'confirmed'],
            'password_confirmation' => 'required'
        ]);

        //'password' => ['required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(@-!_?#|[^\w])).+$/']


        /*
            Wachtwoordvereisten:
            Minstens 1 hoofdletter
            Minstens 1 speciaal teken @_-!?#|
            Minstens 1 kleine letter
            Minstens 1 cijfer
            Minstens 8 tekens
        */

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verificationCode' => Str::random(128)
        ]);
        Mail::to($user->email)->send(new ConfirmEmail($user));
        return $user;
    }


/*
    public function registerMerchant(Request $request){
        $validatedData = $request->validate([
            'merchantName' => "required|min:1"
        ]);
        $user = $this->registerUser($request);

        $merchantRole = Role::where("name", "merchant")->get();
        $user->roles()->attach($merchantRole);

        //todo: validate input
        $newMerchant = new Merchant();
        $newMerchant->name = $request->merchantName;
        $newMerchant->apiName = $this->generateApiNameFromMerchantName($request->merchantName);
        $user->merchant()->save($newMerchant);

        return "ok";
    }
    */

    public function registerCustomer(Request $request){
        $user = $this->registerUser($request);

        $customerRole = Role::where("name", "customer")->get();
        $user->roles()->attach($customerRole);

        $user->customer()->save(new Customer());
        return "ok";
     }










     private function generateApiNameFromMerchantName($merchantName){
        $merchantApiName = strtolower($merchantName);
        $merchantApiName = trim($merchantApiName);
        $merchantApiName = str_replace(' ', '', $merchantApiName);
        $merchantApiName = preg_replace("/[^a-zA-Z0-9-]/", "", $merchantApiName);

        $counter = 1;
        while (Merchant::where("apiName", $merchantApiName)->exists()){
           $merchantApiName = $merchantApiName . $counter;
           $counter++; 
        }

        return $merchantApiName;
     }

     public function previewApiNameFromMerchantName(Request $request){
        $validatedData = $request->validate([
            'fullName' => 'required|min:4'
        ]);
        return $this->generateApiNameFromMerchantName($request->fullName);         
     }








     public function confirmEmail(Request $request, $verificationCode){
        $user = User::where("verificationCode", $verificationCode)->first();
        if($user == null)
        {
            return "Er kon geen gebruiker gevonden worden.";
        }
        else{
            $user->email_verified_at = now();
            $user->save();
            return view("emailConfirmation");
        }
     }
}