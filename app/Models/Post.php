<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//    nurodome, kokius laukus galima pildyti (kontroliuojame, ka leidziame saugoti duomenu bazeje):
    protected $fillable = ['title', 'content', 'img', 'user_id']; //'img' paememe pagal name is add-post formos

    public function user(){
        return $this->belongsTo(User::class); //kuriame atgalini rysi su modeliu (klase) User
    }

    public function comments(){
        return $this->hasMany(Comment::class); //kuriame rysi su komentaru modeliu
    }
}
