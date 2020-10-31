<?php

namespace App\Http\Controllers\Auth;

use App\ForgetPassword;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * send forget password link into mail id.
     *
     * @return void
     */
    function sendForgetPasswordLink(Request $request)
    {
        $user =  User::whereEmail($request->email)->first();
        $token= md5(rand(1, 10) . microtime());;
        /*return view('emails.forgetPassword',['fullname'=>$user->name,
            'reset_url'=>route('password.reset', ['token' => $token, 'email' => $user->email])]);*/
        if( $user )
        {
            $data = [
                $user->email
            ];

          $dataModel =   ForgetPassword::whereEmail($user->email)->whereDate('created_at',date('Y-m-d'))->first();
          if( !$dataModel)
          {
              $dataModel = new ForgetPassword();
              $dataModel->email = $user->email;
              $dataModel->token = $token ;
              $dataModel->created_at = date('Y-m-d H:i:s');
              $dataModel->save();

              Mail::send('emails.forgetPassword', [
                  'fullname'      => $user->name,
                  'reset_url'     => route('password.reset', ['token' => $token, 'email' => $user->email]),
              ], function($message) use($data){
                  $message->subject('Reset Password Request');
                  $message->to($data[0]);
              });

              session()->flash('status','Forget password Link is send into mail-id.');
              return redirect()->route('password.request');
          }

            session()->flash('status','Link already send in same day. please check mail-id or contact to admin.');
            return redirect()->route('password.request');
        }
    }


}
