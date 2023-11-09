<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\organization;
use App\Models\patient;
use App\Models\practicegroup;

use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
   

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

    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
    public function organizationid()
    {
        return 'organizationid';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'organizationid' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Get the input values
        $organizationId = $request->input('organizationid');
        $username = $request->input('username');
        $password = $request->input('password');
    
        // Retrieve the user based on the provided organization_id and username
        $user = Professional::where('organizationid_FK', $organizationId)
            ->where('username', $username)
            ->first();
    
        // Check if the user exists and the provided password matches the hashed password
        if ($user && Hash::check($password, $user->password)) {
            // Authentication successful
    
            // Attempt to authenticate the user
            $credentials = [
                'organizationid_FK' => $organizationId,
                'username' => $username,
                'password' => $password,
            ];
    
            if (Auth::attempt($credentials)) {
                // Authentication successful
    
                // Redirect the user to the desired page or return a response
                return redirect('home');
            } else {
                // Authentication failed
                return back()->withInput()->withErrors('Invalid credentials. Please try again.');
            }
        } else {
            // Authentication failed
            return back()->withInput()->withErrors('Invalid credentials. Please try again.');
        }
    }

   public function orglogin(Request $request, $organization_id)
    {
        // Validate the input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Perform the login authentication
        $username = $request->input('username');
        $password = $request->input('password');

        // Retrieve the user based on the provided organization_id and username
        $user = Professional::where('organizationid_FK', $organization_id)
            ->where('username', $username)
            ->first();
        $organizationid = organization::find($organization_id);
        
        $patientsCount = patient::where('organizationid_FK', $organization_id)->count();
        
        $practicegroupCount = practicegroup::where('organizationid_FK', $organization_id)->count();
        $professionalsCount = Professional::where('organizationid_FK', $organization_id)->count();
        if ($user && Hash::check($password, $user->password)) {
            session(['authenticated_user' => $user, 'organizationid' => $organization_id]);
            // Authentication successful

            // You can add the logic for setting the authenticated user in the session or using Laravel's built-in authentication features.
            // For simplicity, let's assume the authentication is successful and return a success response.
            return redirect()->route('homeorg')->with([
                'user' => $user,
                'patientsCount' => $patientsCount,
                'practicegroupCount' => $practicegroupCount,
                'professionalsCount' => $professionalsCount,
            ]);
           
        }
        else{ return redirect()->route('custom.login',['organizationId' => $organization_id]);;}


       
    }
     
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return redirect()->route('/');
     }
     
     public function logout2(Request $request)
     {
      
       $organizationId = session('organizationid');
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return redirect()->route('custom.login',['organizationId' => $organizationId]);
     }



    public function ipaddress($organizationid)
    {
        $organizationid = organization::find($organizationid);
        
        
        $customLoginUrl = url("/organization/$organizationid");
        
        // Your code logic here
        
        return view('/orgadminview/orglogin', compact('customLoginUrl','organizationid'));
    }
   
}

    
    



