<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle(){
        try{
            $google_user=Socialite::driver('google')->user();

            $user=Customer::where('google_id',$google_user->getId())->first();

            if(!$user){

                $new_user=Customer::create([
                    'name'=>$google_user->getName(),
                    'email'=>$google_user->getEmail(),
                    'google_id'=>$google_user->getId()
                ]);
                Auth::guard('customer')->login($new_user);

                return redirect()->route('front.home');
            }
            else{
                Auth::guard('customer')->login($user);
                return redirect()->route('front.home');
            }
        }
        catch(\Throwable $th){
            dd('something went wrong!'.$th->getMessage());
        }
    }
}
