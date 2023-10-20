<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(8);
        return Inertia::render('Admin/Users/Index',[
            'users' => $users,
        ]);
    }
    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('success', 'Пользователь зарегистрирован');
        return redirect()->route('users.index');
    }

    /*public function edit(string $id){
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'is_admin' => 'required',
        ]); // игнор почты на повторение
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'User отредактирована');
    }

    public function destroy(string $id){
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User удален');
    }*/
}
