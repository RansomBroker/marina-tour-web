<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'description',
        'content',
        'meta_title',
        'meta_description',
    ];
}
