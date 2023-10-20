<?php

namespace App\Http\Controllers;

use App\Models\Basin;
use App\Models\Fish;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function create()
    {
        $fish = Fish::pluck('title', 'id')->all();
        $basins = Basin::pluck('title', 'id')->all();
        return view('front.home.posts.create', compact('fish', 'basins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'coordinate' => 'required|numeric',
            'basin_id' => 'required|integer',
            'fish_id' => 'required|integer',
            'thumbnail' => 'nullable|image',
        ]);
        $data = $request->all();

        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            return redirect()->route('posts.index')->with('error', 'Пользователь не авторизован');
        }

        $data['user_id'] = $user;
        $data['thumbnail'] = Post::uploadImg($request);
        Post::create($data);
        return redirect()->route('home')->with('success', 'Post отправлен на модерацию');

    }

}
