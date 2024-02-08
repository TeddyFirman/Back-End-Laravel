<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'judulPost',
        'postingan',
        'pembuat_post'
    ];

    public function pembuatPost()
    {
        return $this->belongsTo(User::class, 'pembuat_post', 'id');
    }

    public function komen()
    {
        return $this->hasMany(Komen::class, 'post_id', 'id');
    }
}
