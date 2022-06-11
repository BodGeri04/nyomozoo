<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    public function logout()
    {
        Auth::logout();
        return redirect('/website/home')->with('success', 'Sikeresen kiléptél. Várunk vissza!');
    }

    protected function authenticated($user)
    { 
        $splitName = explode(' ', Auth::user()->name, 2);
        $firstName = $splitName[0];
        $lastName = !empty($splitName[1]) ? $splitName[1] : '';
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            return redirect('/admin/home')->with('success', 'Köszöntünk újra ' . $lastName . ' az adminok körében!');
        }
    }
    public function showLoginForm()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }
    protected $maxLoginAttempts = 5;
    protected $lockoutTime = 300;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
