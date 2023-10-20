<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Fish extends Model{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'simple',
        'zachet',
        'chat',
        'trophy',
        'rareTrophy',
        ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
