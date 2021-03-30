<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Requests\Auth\AdminLoginRequest;

class LoginController extends Controller
{
    /**
     * Login View
     */
    public function index()
    {
        if(auth()->guard('admin')->user())
        {
            return redirect()
                    ->route('admin.dashboard');
        }
        
        return view('auth.admin-login');
    }
    
    /**
     * Login  Admin
     * 
     */
    public function login(AdminLoginRequest $request)
    {   
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()
                    ->route('admin.dashboard')
                    ->with('success', 'Logged in.');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login')
                ->with('success', 'Logged out.');
    }

}
