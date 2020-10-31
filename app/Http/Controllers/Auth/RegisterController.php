<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'mobile' => ['required', 'regex:/^[(0-9)]+$/u', 'max:10', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ], [
            'email.required' => 'The email is required.',
            'email.email' => 'The email needs to have a valid format.',
            'email.exists' => 'The email is not registered in the system.',
            'email.unique' => 'The email is already registered in the system.',
        ]
            , [
                'mobile.required' => 'The mobile is required.',
                'mobile.mobile' => 'The mobile needs to have a valid format.',
                'mobile.exists' => 'The mobile is not registered in the system.',
                'mobile.unique' => 'The mobile is already registered in the system.',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'active_status' => 1,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
