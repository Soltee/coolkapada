<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Profile
     */
    public function show()
    {
        $auth = auth()->guard('admin')->user();
        return view('admin.profile', compact('auth'));
    }

    /**
     * Update Profile
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email',
            'password'    => 'required|string|min:8|confirmed'
        ]);

        auth()->guard('admin')->user()->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password'])
        ]);


        return back()
                ->with('success', 'Profile updated');
    }
}
