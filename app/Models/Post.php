<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // import soft delete

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'content', 'image_url'];
}
