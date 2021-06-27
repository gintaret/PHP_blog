<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment','post_id','user_id']; //nustatome, ka leidziame pildyti
    public function post(){
        return $this->belongsTo(Post::class); //kuriame rysi su Post modeliu
    }

    public function user(){
        return $this->belongsTo(User::class); //kuriame rysi su User modeliu
    }
}
