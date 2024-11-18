<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username atau email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if ($validator->fails()) {
            flash('Gagal Login');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $validator->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            flash('Berhasil Login');
            return redirect()->intended('/back-office/dashboard');
        }
        flash()->addError('Gagal Login');
        return back()->withErrors([
            'password' => 'Password tidak sesuai.',
        ])->withInput();
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        flash('Berhasil Logout');
        return redirect('/login');
    }
}
