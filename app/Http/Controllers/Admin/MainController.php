<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller{

    public function index(){
        $posts = Post::where('is_moderate', '1')->paginate(10);
        return Inertia::render('Admin/Home', [
            'posts' => $posts,
        ]);
    }
}
