<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($website)
    {
        return Socialite::driver($website)->redirect();
    }

    public function handleProviderCallback($website)
    {
        if($website=='github'){
            $user = Socialite::driver($website)->user();
        }elseif ($website=='google'){
            $user= Socialite::driver('google')->stateless()->user();
        }elseif ($website=='facebook'){
            $user=Socialite::driver('facebook')->user();

        }


        $user_found=User::where('email', $user->getEmail())->first();

        if($user_found){
            Auth::login($user_found);
            return redirect('/');
        }else{
            $new_user=new User;
            if($website=='github'){
                $new_user->name=$user->getNickname();
            }
            if($website=='google'){
                $new_user->name=$user->getName();
            }

            $new_user->email=$user->getEmail();
            $new_user->password=bcrypt('123456');


            if($new_user->save()){
                Auth::login($new_user);
                return redirect('/');
            }
        }


    }
}
