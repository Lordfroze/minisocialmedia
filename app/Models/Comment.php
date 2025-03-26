<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // import soft delete

class Comment extends Model
{
    // menentukan data yang bisa di olah
    use SoftDeletes;
    protected $fillable = ['user_id', 'post_id', 'content'];

}
