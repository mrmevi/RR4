<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Basin;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BasinController extends Controller
{
    public function index()
    {
        $basins = Basin::paginate(10);
        return Inertia::render('Admin/Basins/Index', [
            'basins' => $basins
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Basins/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:App\Models\Basin',
        ]);
        Basin::create($request->all());
        $request->session()->flash('success', 'Basin добавлена');
        return redirect()->route('basins.index');
    }

    public function edit(string $id)
    {
        $basin = Basin::find($id);
        //сделать ресурс колекции
        return Inertia::render('Admin/Basins/Edit', [
            'basin' => $basin,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $basin = Basin::find($id);
        $basin->update($request->all());
        return redirect()->route('basins.index')->with('success', 'Basin изменен');
    }

    public function destroy(string $id)
    {
        $basin = Basin::find($id);
        if ($basin->posts->count()) {
            return redirect()->back()->with('error', 'У этого basin есть привязанные посты');
        } else {
            $basin->delete();
            return redirect()->back()->with('success', 'Basin удален');
        }
    }
}
