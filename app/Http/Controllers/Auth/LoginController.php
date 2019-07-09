<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginUsers(Request $r)
    {
        \Session::reflash();
        $credentials = $r->only('email', 'password'); 
        if ( ! \Auth::attempt($credentials))
        {
            \Session::flash('error', 'Dados de Login Incorretos');
            return redirect('/Logar');
        }else{
            \Session::forget('error');
            if(\Session::has('redirect')){
                return redirect(\Session::get('redirect'));
            }else{
                if(\Auth::user()->tipo == '1'){
                    \Session::flash('sucess', 'Login efetuado com sucesso!');
                    return redirect('/Instrutor/Perfil');
                }elseif(\Auth::user()->tipo == '2'){
                    if(\Session::has('redirect')){
                        return redirect(\Session::get('redirect'));
                    }else{
                        \Session::flash('message', 'Login efetuado com sucesso!');
                        return redirect('/Aluno/Dashboard');
                    }
                }elseif(\Auth::user()->tipo == '3'){
                    \Session::flash('sucess', 'Login efetuado com sucesso!');
                    return redirect('/Afiliado/Dashboard');
                }elseif(\Auth::user()->tipo == '0'){
                    \Session::flash('sucess', 'Login efetuado com sucesso!');
                    return redirect('/home');
                }
            }
            
        }       
    }


}
