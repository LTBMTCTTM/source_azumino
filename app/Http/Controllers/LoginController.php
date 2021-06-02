<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.custom')->except(['logout', 'store'] );

    }

    public function index(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $username_credential = $request->only('admin_id');
            $username_rules = [
                'admin_id' => 'required'
            ];
            $username_validator = Validator::make($username_credential, $username_rules);
            if ($username_validator->fails()) {
                $errors = ['password' => '正しいユーザ名とパスワードを入力してください。'];
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);
            }

            $password_credential = $request->only('password');
            $password_rules = [
                'password' => 'required'
            ];
            $password_validator = Validator::make($password_credential, $password_rules);
            if ($password_validator->fails()) {
                $errors = ['password' => '正しいユーザ名とパスワードを入力してください。'];
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);
            }

            $credentials = $request->only('admin_id', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('/');
            } else {
                $errors = ['password' => '正しいユーザ名とパスワードを入力してください。'];
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            Session::flush();
            return redirect('login');
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function username()
    {
        return 'admin_id';
    }

    public function changeConfig(Request $request){
        $validator = Validator::make($request->all(), [
            'url_config' => 'required',
            'username_config' => 'required',
            'password_config' => 'required',
        ]);
        if ($validator->fails()) {
            $res = ['status' => false];
            $res['message'] = $validator->errors();
            return response()->json($res);
        }

    }

}
