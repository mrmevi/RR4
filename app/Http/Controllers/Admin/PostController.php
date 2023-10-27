<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Basin;
use App\Models\Fish;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_moderate', '0')->paginate(10);
        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
        ]);
    }

    public function decide($id)
    {
        $post = Post::find($id);
        $post['is_moderate'] = 0;
        $post->update();
        return redirect()->back()->with('success', 'Post принят');
    }

    public function dontDecide($id)
    {

        $post = Post::find($id);
        $post['is_moderate'] = 1;
        $post->update();
        return redirect()->back()->with('success', 'Post перемещен на модерацию');
    }

    public function create()
    {
        $fish = Fish::pluck('title', 'id')->all();
        $basins = Basin::pluck('title', 'id')->all();
        return Inertia::render('Admin/Posts/Create', [
            'fish' => $fish,
            'basins' => $basins,
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'coordinate' => 'required|numeric',
            'basin_id' => 'required|integer',
            'fish_id' => 'required|integer',
        ]);
        $data = $request->all();
        $images = $data['images'];
        unset($data['images']);
        $data['is_moderate'] = 0;

        $post = Post::create($data);

        Image::uploadImg($images, $post->id);


        /*if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            return redirect()->route('posts.index')->with('error', 'Пользователь не авторизован');
        }
        $data['user_id'] = $user;

        $data['thumbnail'] = Post::uploadImg($request);*/


        return redirect()->route('posts.index')->with('success', 'Post добавлен');
    }


    public function edit(string $id)
    {
        $fish = Fish::pluck('title', 'id')->all();
        $basins = Basin::pluck('title', 'id')->all();
        $post = Post::find($id);
        $images = $post->images;
        return Inertia::render('Admin/Posts/Edit', [
            'fish' => $fish,
            'basins' => $basins,
            'post' => $post,
            'images' => $images,
        ]);
    }


    public function update(Request $request, string $id)
    {
        dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'coordinate' => 'required|numeric',
            'basin_id' => 'required|integer',
            'fish_id' => 'required|integer',
        ]);

        $data = $request->all();
        $images = $data['images'];
        unset($data['images']);

        $post = Post::find($id);
        $data = $request->all();
        if ($file = Post::uploadImg($request, $post->thumbnail)) {
            $data['thumbnail'] = $file;
        }
        $post->update($data);

        return redirect()->route('admin.index')->with('success', 'Post изменен');
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);
        /*if ($post->thumbnail) {
            Storage::delete($post->thumbnail);
        }*/
        $post->delete();
        return redirect()->back()->with('success', 'Post удален');
    }
}
