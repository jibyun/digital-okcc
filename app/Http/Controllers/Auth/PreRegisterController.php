<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Mail\TestMailSender;
use App\Notifications\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class PreRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PreRegister Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the pre-registration of new users.
    | Once it passes the basic validation registration request
    | will be mailed to the system admin
    |
    */

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendMail(Request $request)
    {
        $this->validator($request->all())->validate();

        Notification::route('mail', 'gyounlee@yahoo.ca')
            ->notify(new RegistrationRequest($request));
        return back()->with('status', __('messages.receivedregister'));
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
            'name' => 'required|string|max:255',
           // 'email' => 'required|string|email|max:255|unique:users',
           // 'password' => 'required|string|min:6|confirmed',
        ]);
    }
}
