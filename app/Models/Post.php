<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // import soft delete

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'content', 'image_url'];

    // Relasi dengan model User , mendefinisikan bahwa setiap post dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Comment, mendefinisikan bahwa setiap post memiliki banyak komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi dengan model Like, mendefinisikan bahwa setiap post memiliki banyak like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
