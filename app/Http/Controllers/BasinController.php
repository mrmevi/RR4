<?php

namespace App\Http\Controllers;

use App\Models\Basin;
use Illuminate\Http\Request;

class BasinController extends Controller{

    public function index(){
        $basins = Basin::paginate(10);
        return view('front.home.basins.index', compact('basins'));
    }

    public function show($slug){
        $basin = Basin::where('slug', $slug)->firstOrFail();
        $posts = $basin->posts()->with('fish')->orderBy('id','desc')->paginate(2);
        return view('front.home.basins.show', compact('basin', 'posts'));
    }
}
