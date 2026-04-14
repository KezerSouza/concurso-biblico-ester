<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate(
            ['password' => ['required']],
            ['password.required' => 'O campo senha é obrigatório.'],
        );

        if (! Hash::check($request->password, config('app.password'))) {
            return back()->withErrors(['password' => 'Senha incorreta.']);
        }

        $request->session()->put('authenticated', true);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('authenticated');

        return redirect()->route('login');
    }
}
