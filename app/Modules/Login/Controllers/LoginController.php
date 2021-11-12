<?php
namespace App\Modules\Login\Controllers;

use App\Helpers\getUsers;
use App\Http\Controllers\Controller;
use App\User as User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Response;

class LoginController extends Controller
{

    /**
     * Laravel  6.0
     * @package COMPANY MANAGEMENT
     * @author  RADHIKA
     * @param  Request $request
     * @Date   11-05-2021
     * @module Login
     * @Input  
     * output login page
     * Description: login
     **/
    
    public function index(Request $request)
    {
        return view('Login::login');
    }
    public function dashboard()
    {
        return view('Login::dashboard');
    }



     /**
     * Laravel  6.0
     * @package COMPANY MANAGEMENT
     * @author  RADHIKA
     * @param  Request $request
     * @Date   11-05-2021
     * @module Login
     * @Input  
     * output admin or user page
     * Description: 
     **/




    public function login(Request $request)
    { 
       
       $request->validate([
        
        'email' => 'email|required',
        'password'=>'required',
    ]);
    
    $email = $request->email;
    $password=$request->password;
    
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            // return  2;
            // return Auth::user()->user_type; 
            if(Auth::user()->user_type =="admin"){
                // return 1;
                //$data=Auth::user()->name;
                return redirect('login/dashboard');
               
            }else if(Auth::user()->user_type =="user"){
                $data=Auth::user()->name;
                return redirect('login/dashboard');
            } else{
                return redirect()->back()->with('error','invalid user');
            }
        } else {
            return 'error';

        }
    }



    
     /**
     * Laravel  6.0
     * @package COMPANY MANAGEMENT
     * @author  RADHIKA
     * @param  Request $request
     * @Date   11-05-2021
     * @module Login out
     * @Input  
     * output index page
     * Description: 
     **/


    public function logout()

    {
            Auth::logout();
            return redirect('/');
            
            return view('Login::login');
    }




}
