<?php

namespace App\Models;

use App\Models\Traits\HasUUid;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';

    use HasUUid;
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
