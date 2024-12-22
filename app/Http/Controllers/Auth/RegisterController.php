<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/';

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

        // dd($data);
        $register = $data['register'];
        $registerField = filter_var($register, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255', 'unique:users'],
        //     'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        $rules = [
            'register' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        
        // Add email validation if it's determined to be an email
        if ($registerField === 'email') {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            unset($rules['register']); // Remove the 'register' rule as it's replaced by 'email'
            $data['email'] = $data['register'];
            unset($data['register']);

        } else {

            $rules['name'] = ['required', 'string', 'max:255', 'unique:users'];
            unset($rules['register']); // Remove the 'register' rule as it's replaced by 'name'
            $data['name'] = $data['register'];
            unset($data['register']);
            // dd($rules['name']);
        }

        return Validator::make($data, $rules);

    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        // dd($data);
        $registerField = filter_var($data['register'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if ($registerField === 'email') {

            $data['email'] = $data['register'];
            unset($data['register']);
            
            return User::create([

                'name' => null,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role'=> User::count() === 0 ? 'admin' : 'user'
            ]);

        } else {

            $data['name'] = $data['register'];
            unset($data['register']);

            return User::create([

                'name' => $data['name'],
                'email' => null,
                'password' => Hash::make($data['password']),
                'role'=> User::count() === 0 ? 'admin' : 'user'
            ]);
            
        }
        // return User::create([

        //     'register' => $data['register'],
        //     'password' => Hash::make($data['password']),
        //     'role'=> User::count() === 0 ? 'admin' : 'user'
        // ]);
    }
}
