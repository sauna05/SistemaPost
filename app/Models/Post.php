<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'imagen',
        
    ];
   
    //relacion entre modelos de uno a muchos
    public function coments()
    {
        return $this->hasMany(Coment::class, 'id_post'); 
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
