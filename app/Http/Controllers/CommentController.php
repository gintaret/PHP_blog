<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Post $post){
        Comment::create([
            'comment' => request('body'), //comment yra DB laukas, o body ateina is formos
            'post_id' => $post->id, //post_id - nes routes paduodame {post} (riestiniuose reiskia post_id)
            'user_id' => Auth::id()
        ]);
        return back(); //kai parasysiu komentara, mane grazins i ta posta, kuri pakomentavau
    }
}
