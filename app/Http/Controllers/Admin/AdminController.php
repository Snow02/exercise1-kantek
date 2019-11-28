<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdmin;
use App\Http\Requests\RegisterAdmin;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $admins = Admin::all();
        return view('admin.list',compact('admins'));
    }
    public function login()
    {
        return view('admin.login');
    }

    public function postLogin(LoginAdmin $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $credentials  = ['username' => $username , 'password' =>$password];

        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('admin.index');
        }else{
            return redirect()->back()->with('error','Username or password incorrect');
        }


    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function register()
    {
        return view('admin.add');
    }

    public function postRegister(RegisterAdmin $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->get('password'));
        Admin::create(['name' => $input['name'], 'username' => $input['username'],'email'=>$input['email'],'password'=> bcrypt($request->get('password'))]);
        return redirect()->back()->with('success', 'Register admin account success');
    }

}
