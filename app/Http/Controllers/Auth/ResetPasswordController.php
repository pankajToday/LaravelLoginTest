<?php

namespace App\Http\Controllers\Auth;

use App\ForgetPassword;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * Reset forget password and return into home page.
     *
     * @return void
     */
    function passwordUpdate(Request $request )
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
        ]);


         $dataModel =   ForgetPassword::whereEmail($request->email)
                        ->whereDate('created_at',date('Y-m-d'))
                         ->where('token',$request->token)
                        ->first();

        if(  $dataModel )
        {
            $user =  User::where('email',$request->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            ForgetPassword::whereEmail($request->email)
                ->whereDate('created_at',date('Y-m-d'))
                ->where('token',$request->token)
                ->delete();
            $this->guard()->login($user);
            return redirect()->route('home');
        }
        session()->flash('message' ,'Unable to reset password!');
        session()->flash('status' ,'danger');
        return redirect()->route('home');
    }


}
