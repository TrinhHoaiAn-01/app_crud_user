<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CrudUserController extends Controller
{
    public function register(): View
    {
        return view('register');
    }

    public function storeRegister(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);

        User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect('/login')->with('status', 'Dang ky thanh cong. Vui long dang nhap.');
    }
}
