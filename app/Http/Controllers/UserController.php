<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{

    public function registerCreate()
    {
        return Inertia::render('User/Register');
    }

    public function loginCreate()
    {
        return Inertia::render('User/Login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if (!Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
        ])) {
            return redirect()
                ->route('login.create')
                ->withErrors(['email' => 'Пользователь не найден, либо данные введены неверно']);
        }
        return redirect()->route('home');
        /*if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'Пользователь авторизован');
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('home');
            }
        }
        return redirect()->back()->with('error', 'Неверный логин или пароль');*/
    }
    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    }
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('success', 'Пользователь зарегистрирован');
        /*Auth::login($user);*/
        return redirect()->route('home');
    }
    /*
         public function profile($id){
             $user = User::where('id', $id)->firstOrFail();
             return view('front.home.user.index', compact('user'));
         }*/

}
