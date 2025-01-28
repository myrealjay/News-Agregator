<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable=[
        'title',
        'author',
        'description',
        'content',
        'source',
        'category',
        'url',
        'image_url',
        'published_at'
    ];
}
