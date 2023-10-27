<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if($user->id === 1){
            $user->is_admin = true;
            $user->is_approved = true;
            $user->save();
        }

        return $user;
    }

    public function showRegistrationForm($hash)
    {
        $hash = Link::where('hash', $hash)->get();
        if(isset($hash[0])){
            return view('auth.register', compact('hash'));
        }
        return redirect()->route('home');
    }

    public function register(Request $request, $hash)
    {
        $link = Link::where('hash', $hash)
            ->where('user_id', null)
            ->get();
        $link = $link[0];
        if(!isset($link)){
            return redirect()->route('home');
        }

        $data = $this->validator($request->all());
        $user = $this->create($data->validated());
        $link->user_id = $user->id;
        $link->save();

        $credentials = [
            'login' => $request->get('login'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return redirect()->route('home');
    }
}
