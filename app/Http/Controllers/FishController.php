<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Illuminate\Http\Request;

class FishController extends Controller{

    public function index(){
        $fish = Fish::paginate(10);
        return view('front.home.fish.index', compact('fish'));
    }

    public function show($slug){
        $fish = Fish::where('slug', $slug)->firstOrFail();
        $posts = $fish->posts()->with('basin')->orderBy('id','desc')->paginate(2);
        return view('front.home.fish.show', compact('fish', 'posts'));
    }


}
