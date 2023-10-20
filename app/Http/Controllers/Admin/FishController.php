<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fish;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FishController extends Controller
{

    public function index()
    {
        $fish = Fish::paginate(8);
        return Inertia::render('Admin/Fish/Index', [
            'fish' => $fish
        ]);
    }


    public function create()
    {
        return Inertia::render('Admin/Fish/Create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:App\Models\Fish',
            'simple' => 'required',
            'zachet' => 'required',
            'chat' => 'required',
            'trophy' => 'required',
            'rareTrophy' => 'required',
        ]);
        Fish::create($request->all());
        $request->session()->flash('success', 'Fish добавлена');
        return redirect()->route('fish.index')->with('success', 'Наименование рыбы добавлено');
    }


    public function edit(string $id)
    {
        $fish = Fish::find($id);
        return Inertia::render('Admin/Fish/Edit',[
            'fish' => $fish,
        ]);
    }


    public function update(Request $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'simple' => 'required',
            'zachet' => 'required',
            'chat' => 'required',
            'trophy' => 'required',
            'rareTrophy' => 'required',
        ]);
        $fish = Fish::find($id);
        $fish->update($request->all());
        return redirect()->route('fish.index')->with('success', 'Fish отредактирована');
    }


    public function destroy(string $id)
    {
        $fish = Fish::find($id);
        if ($fish->posts->count()) {
            return redirect()->back()->with('error', 'У этой fish есть привязанная статья');
        } else {
            $fish->delete();
            return redirect()->back()->with('success', 'Fish удалена');
        }

    }
}
