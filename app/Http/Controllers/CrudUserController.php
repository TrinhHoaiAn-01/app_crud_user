<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CrudUserController extends Controller
{
    public function home(): View
    {
        return view('welcome', [
            'sampleUser' => User::orderBy('id')->first(),
        ]);
    }

    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('users.list');
        }

        return view('login');
    }

    public function list(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Vui long dang nhap de tiep tuc.');
        }

        return view('list', [
            'users' => User::orderBy('id')->paginate(10),
        ]);
    }

    public function register(): View
    {
        return view('register');
    }

    public function view(Request $request): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Vui long dang nhap de tiep tuc.');
        }

        $userId = (int) $request->query('id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('users.list')->with('status', 'Khong tim thay user.');
        }

        return view('view', [
            'user' => $user,
        ]);
    }

    public function edit(Request $request): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Vui long dang nhap de tiep tuc.');
        }

        $userId = (int) $request->query('id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('users.list')->with('status', 'Khong tim thay user.');
        }

        return view('update', [
            'user' => $user,
        ]);
    }

    public function storeLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('users.list');
        }

        return back()
            ->withErrors([
                'username' => 'Thong tin dang nhap khong hop le.',
            ])
            ->onlyInput('username');
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

        return redirect()->route('login')->with('status', 'Dang ky thanh cong. Vui long dang nhap.');
    }

    public function storeUpdate(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Vui long dang nhap de tiep tuc.');
        }

        $userId = (int) $request->input('id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('users.list')->with('status', 'Khong tim thay user.');
        }

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $userId],
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
        ]);

        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.list')->with('status', 'Cap nhat user thanh cong.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Dang xuat thanh cong.');
    }

    public function delete(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Vui long dang nhap de tiep tuc.');
        }

        $userId = (int) $request->query('id');

        if ($userId > 0) {
            User::whereKey($userId)->delete();
        }

        return redirect()->route('users.list')->with('status', 'Xoa user thanh cong.');
    }
}
