<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller{

    /*public function index(){

    }*/

    /*public function index(){
        $posts = Post::with('basin','fish','user')->where('is_moderate', '0')->orderBy('id', 'desc')->paginate(3);
        return view('front.home.index', compact('posts'));
    }

    public function show($slug){
        $post = Post::orWhere(function($query) use ($slug){
            $query->where('slug', $slug)
                ->where('is_moderate', '=', '0');
        })->firstOrFail();
        $post->views += 1;
        $post->update();
        return view('front.home.article', compact('post'));
    }*/
}
