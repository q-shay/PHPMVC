<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('user_id')) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'password.required' => 'A senha é obrigatória.'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            session([
                'user_id' => $user->id,
                'user_nome' => $user->nome,
                'user_email' => $user->email
            ]);

            return redirect()->route('home')
                ->with('success', 'Bem-vindo, ' . $user->nome . '!');
        }

        return back()
            ->withInput(['email' => $validated['email']])
            ->with('error', 'E-mail ou senha inválidos.');
    }

    public function logout(Request $request)
    {
        session()->forget(['user_id', 'user_nome', 'user_email']);
        session()->flush();

        return redirect()->route('login')
            ->with('success', 'Você saiu do sistema.');
    }

    public function showRegister()
    {
        if (session()->has('user_id')) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'As senhas não conferem.'
        ]);

        $user = User::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        session([
            'user_id' => $user->id,
            'user_nome' => $user->nome,
            'user_email' => $user->email
        ]);

        return redirect()->route('home')
            ->with('success', 'Conta criada com sucesso! Bem-vindo, ' . $user->nome . '!');
    }
}
