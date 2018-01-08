<?php

namespace App\Http\Controllers;

use App\Slika;
use App\Glas;
use App\Comment;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        if (Auth::check()) {
             return redirect()->route('domov');
        } else {
            return view('kmalu');
        }
    }
    public function getMeme($id) {
        $post = Slika::find($id);
        $comments = Comment::where('post_id', '=', $id)->get();
        $upvoti = Glas::where('post_id', '=', $post->id)->where('type', '=', 1)->count();
        $downvoti = Glas::where('post_id', '=', $post->id)->where('type', '=', 2)->count();
        $skupni_glasovi = $upvoti - $downvoti;
        return view('meme', ['post' => $post, 'comments' => $comments, 'skupni_glasovi' => $skupni_glasovi]);
    }

    public function domov()
    {
        if (Auth::check()) {
             return view('domov');
        } else {
            return view('kmalu');
        }
    }
}
