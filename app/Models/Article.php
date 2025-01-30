<?php

namespace App\Models;

use App\Models\Traits\HasUUid;
use App\Traits\HasArticleFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasArticleFilter;
    use HasFactory;
    use HasUUid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';

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
