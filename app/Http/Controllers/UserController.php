<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Http\Models\User;
use App\Http\Services\BusinessServices\UserBusinessService;
use App\Http\Services\Utility\MyLogger;
class UserController extends Controller
{



    /**
     * Validates the Login Form
     *
     * @param
     * Request
     */
    private function loginValidateForm(Request $request)
    {
        $rules = [
            'username' => 'Required | Max:30',
            'password' => 'Required | Between:5,30'
        ];

        $this->validate($request, $rules);
    }

    /**
     * Validates the Register Form
     *
     * @param
     * Request
     */
    private function registerValidateForm(Request $request)
    {
        $rules = [
            'username' => 'Required | Max:30',
            'password' => 'Required | Between:5,30',
            'firstName' => 'Required | Max:30',
            'lastName' => 'Required | Max:30',
            'email' => 'Required | Max:30'
        ];

        $this->validate($request, $rules);
    }

    /**
     * Logs user in, set up session, send login credentials to dao
     * @param Request $request
     * @throws ValidationException
     * @throws Exception
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function Login(Request $request)
    {
        MyLogger::info("User loging in......... ");
        // trys to validate throws validation error if failed rules
        try {
            $this->loginValidateForm($request);
        } catch (ValidationException $e1) {
            MyLogger::warning("Form not validated");
            throw $e1;
        }
        try {
            //flush session
            $request->session()->flush();
            Session::flush();
            
            //get fields from view
            $userN = $request->input('username');
            $uPass = $request->input('password');
            $user = new User(null, null, null, null, $userN, $uPass);
            $ubs = new UserBusinessService();

            //check if found user
            $result = $ubs->UserLogin($user);
            if ($result != null) {
                //put user into session, return home
                
                MyLogger::info($userN. " Logged in ");
                Session::put('userid', $result->getId());
                Session::put('user', $result);
                    return view('home');
            } else {
                MyLogger::warning("Username: " .$userN. " Password: ".$uPass. " failed to login" );
                // back to login with fail msg
                return view('login')->with('msg', 'Login failed please try again');
            }
        } catch (Exception $e2) {
            MyLogger::warning("User could not login" );
            throw $e2;
        }
    }

    /**
     * Register new user, send post request fields to dao
     *
     * @param
     * Request
     * @return view(login) or register view with errors
     */
    public function Register(Request $request)
    {
        // trys to validate throws validation error if failed rules
        try {
            $this->registerValidateForm($request);
        } catch (ValidationException $e1) {
            throw $e1;
        } try {
            // creates user model
            $userN = $request->input('username');
            $uPass = $request->input('password');
            $uFN = $request->input('firstName');
            $uLN = $request->input('lastName');
            $uEmail = $request->input('email');
            $user = new User(null, $uFN, $uLN, $uEmail, $userN, $uPass);
            $ubs = new UserBusinessService();
            // returns bool
            $result = $ubs->UserRegister($user);
            if ($result == 1){
                return view('login')->with('msg', 'Sucessfully created an account');
            }else if($result == -2){
                return view('register')->with('msg', "Username is taken, pick a new one :/");
            }else{
                return view('register')->with('msg', "Failed to create account");
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }

    /**
     * flushes out session and sends to login page
     *
     * @return route(login)
     */
    public function Logout(Request $request)
    {
        try {
            MyLogger::info("User logging out....................");
            Session::flush();
            $request->session()->flush();
            return view("login");
        } catch (Exception $e2) {
            throw $e2;
        }
    }

}
