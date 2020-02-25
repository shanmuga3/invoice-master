<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Lang;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function authenticate(Request $request)
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required|min:6',
        );

        $attributes = array(
            'username' => 'User Name',
            'password' => 'Password',
        );

        $this->validate($request,$rules,[],$attributes);

        $remember = ($request->remember == 'on');
        if (auth()->guard('admin')->attempt($request->only('username','password'),$remember)) {
            $admin = Admin::where('username', $request->username)->first();
            
            if(!$admin->status) {
                auth()->guard('admin')->logout();
                flashMessage('danger', Lang::get('admin_messages.failed'), "you are Blocked by Admin. Please contact admin to login");
                return redirect()->route('admin.login');
            }

            return redirect()->route('admin.dashboard');
        }
        flashMessage('danger', Lang::get('admin_messages.failed'), "Invalid Username / password");
       	return redirect()->route('admin.login');        
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}