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
use App\Mail\confirmEmail_v2;
use App\Mail\NewMerchantNotification;
use Illuminate\Support\Facades\Mail;
use Str;


use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ["resendConfirmEmail","sendBatchOfEmails",'logMerchantOut','verifyEmailNotice','logMerchantIn','login', 'registerCustomer', 'registerMerchant', 'previewApiNameFromMerchantName', 'confirmEmail']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth("api")->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        else{
            if(auth("api")->user()->hasAnyRole("merchant")){
                return response()->json("user is a merchant",401);
            }
            if(auth("api")->user()->hasVerifiedEmail()){
                return $this->respondWithToken($token);    
            }
            else{
                return response()->json("emailaddres not verified",401);
            }
        }
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
            return redirect("/admin/dashboard");
        }
        else{
            return back()->withError('Het opgegeven wachtwoord of e-mailadres is niet correct, probeer opnieuw.');
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
            'merchantPhone' => "required"
            ]);

        $user = $this->registerUser($request);
        $merchantRole = Role::where("name", "merchant")->get();
        $user->roles()->attach($merchantRole);

        //todo: validate input
        $newMerchant = new Merchant();
        $newMerchant->name = $request->merchantName;
        $newMerchant->apiName = $this->generateApiNameFromMerchantName($request->merchantName);
        $newMerchant->merchantPhone = $request->merchantPhone;
        $newMerchant->address_street = $request->address_street;
        $newMerchant->address_number = $request->address_number;
        $newMerchant->address_zip = $request->address_zip;
        $newMerchant->address_city = $request->address_city;
        $newMerchant->tax_number = $request->tax_number;
        
        $user->merchant()->save($newMerchant);

        Mail::to("info@speedmeal.be")->send(new NewMerchantNotification($user));
        return view("postRegistration")->with("userId", $user->id);
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

    public function logMerchantOut(){
        auth()->logout();
        return redirect("/admin/login");
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
            'expires_in' => auth("api")->factory()->getTTL() * 60 * 3
        ]);
    }









    public function registerUser($request){
        $request->validate([
            'firstName' => 'required|min:1|string',
            'lastName' => 'required|min:1|string',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => ['required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', 'confirmed'],
            'password_confirmation' => 'required',
            'mobilePhone' => "required",
            'acceptsTermsAndConditions' => "required|accepted"
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
            'verificationCode' => Str::random(128),
            'mobilePhone' => $request->mobilePhone
        ]);
        
        Mail::to($user->email)->send(new ConfirmEmail($user));
        return $user;
    }


    public function resendConfirmEmail($userId){
        $user = User::find($userId);
        Mail::to($user->email)->send(new ConfirmEmail($user));
        return response()->json("ok");
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
        return response()->json(["message" => "ok", "userId" => $user->id]);
     }












     private function generateApiNameFromMerchantName($merchantName){
        $merchantApiName = strtolower($merchantName);
        $merchantApiName = trim($merchantApiName);
        $merchantApiName = str_replace(' ', '', $merchantApiName);
        $merchantApiName = str_replace('&', 'en', $merchantApiName);
        $merchantApiName = preg_replace("/[^a-zA-Z0-9-]/", "", $merchantApiName);
        $merchantApiName = str_replace('/', '', $merchantApiName);
        $merchantApiName = str_replace('-', '', $merchantApiName);
        $merchantApiName = str_replace('?', '', $merchantApiName);
        $merchantApiName = str_replace('#', '', $merchantApiName);
        $merchantApiName = str_replace('%', '', $merchantApiName);
        $merchantApiName = str_replace('@', '', $merchantApiName);
        $merchantApiName = str_replace(':', '', $merchantApiName);
        $merchantApiName = str_replace('.', '', $merchantApiName);
        $merchantApiName = str_replace("'", '', $merchantApiName);


        $forbiddenNames = [
            "restaurant",
            "restaurants",
            "aanmelden",
            "registreren",
            "admin",
            "administrator",
            "home",
            "speedmeal",
            "horecazaak",
            "horecazaken",
            "over",
            "over-ons",
            "faq",
            "contact",
            "register",
            "signup",
            "home",
            "startpagina"
        ];

        $counter = 1;
        while (Merchant::where("apiName", $merchantApiName)->exists() || in_array($merchantApiName, $forbiddenNames)){
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

   







     

    function sendBatchOfEmails(){
        $user = User::first();
        $emailAddresses = [
            /*
            "michele_coene@hotmail.com",
            "michele.coene@hotmail.com",
            "marie-michele.cecile.coene@vub.be",
            "arnaud.verpoucke@hotmail.com",
            "arnaud.verpoucke@student.howest.be",
            "iemand4@gmail.com",
            "arnaud@plenso.be",
            "milat.omed@studiohyperdrive.be",
            "qais187@gmail.com",
            "milatomed@gmail.com",
            "omedmil@cronos.be",
            "milat.omed@student.howest.be",
            "oksana.gorin@student.howest.be",
            "oksana.gorin@somko.be",
            "oksana_gorin@mail.ru",
            "oksana.gorin.i@gmail.com",
            "arno.arzumanyan@student.howest.be",
            "arnogohar@yandex.ru",
            "arnogohar@gmail.com",
            "arno.arzumanyan@deloitte.com",
            "dominos.roeselare@hotmail.com"*/
        ];

        foreach ($emailAddresses as $emailAddress) {
            Mail::to($emailAddress)->send(new confirmEmail($user));
        }     
    }
}