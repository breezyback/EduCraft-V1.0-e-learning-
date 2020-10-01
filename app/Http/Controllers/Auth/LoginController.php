<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Traits\CommandTrait;

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
    use CommandTrait;

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
        /*$this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:teacher')->except('logout');*/
    }
    
    public function showLoginForm(Request $request)
    {
        $categories1 = $this->categ();
        $formations1 = $this->formation();

        $check = false;

        if( isset($_GET['success']) )
        {
            $check = true;
        }

        return view('auth.login', ['check' => $check, 'categories1' => $categories1, 'formations1' => $formations1]);
    }

    public function login(Request $request)
    {
        // Validate the form data
        /*$validator = $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|string'
        ]);*/
        
        // Attempt to log the student in
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if(isset($_POST['success'])) {
                return redirect(url('/course/'.$_POST['id']));
            }
            else {
                return redirect()->intended(route('student.dashboard'));
            }
        } 
        // Attempt to log the teacher in
        else if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if(isset($_POST['success'])) {
                return redirect()->back();
            }
            else { 
                return redirect()->intended(route('teacher.dashboard'));
            }
        }
        // Attempt to log the admin in
        else if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if(isset($_POST['success'])) {
                return redirect()->back();
            }
            else {   
                return redirect()->intended(route('admin.dashboard'));
            }
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
        // if Auth::attempt fails (wrong credentials) create a new message bag instance.
        //$errors = new MessageBag(['password' => ['Adresse email et/ou mot de passe incorrect.']]);
        // redirect back to the login page, using ->withErrors($errors) you send the error created above
        //return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'password'));
    }
}
