<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'sources',
        'categories',
        'authors',
    ];

    /**
     * The attributes that needs to be transformed.
     *
     * @var list<string>
     */
    protected $casts = [
        'sources' => 'array',
        'categories' => 'array',
        'authors' => 'array'
    ];
}
