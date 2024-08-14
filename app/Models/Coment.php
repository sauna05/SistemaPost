<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    use HasFactory;
    protected $fillable = ['id_post', 'content','user_id'];
    //relacion entre los modelo de muchos a uno
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}
