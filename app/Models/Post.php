<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model{

    protected $fillable = [
        'title',
        'description',
        'content',
        'coordinate',
        'basin_id',
        'fish_id',
        'user_id',
        'thumbnail',
        'is_moderate',
    ];

    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function basin(){
        return $this->belongsTo(Basin::class);
    }
    public function fish(){
        return $this->belongsTo(Fish::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }



    public static function uploadImg(Request $request, $image = null){
        if ($request->hasFile('thumbnail')){
            if ($image) Storage::delete($image);
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}");
        }
        return null;
    }

    public function getImage(){
        if (!$this->thumbnail){
            return asset('assets/noImg.png');
        }
        return asset("uploads/{$this->thumbnail}");
    }

    public function getPostDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');
    }

}
