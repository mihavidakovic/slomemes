<?php

namespace App\Http\Controllers;

use App\Post;
use App\Glas;
use App\Comment;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
	public function komentarjiJSON($id, Request $request) {
        $komentarji = Comment::where('post_id', '=', $id)->with('user')->get();
        $num = Comment::where('post_id', '=', $id)->count();
        return response()->json(['komentarji' => $komentarji, 'num' => $num])->withCallback($request->input('callback'));
    }

    public function addComment($id, Request $request) {
    	$c = new Comment;
    	$c->post_id = $id;
    	$c->user_id = Auth::user()->id;
    	$c->content = $request->input('content');
    	$c->save();
    	return response()->json([
    		'user' => Auth::user(),
    		'komentar' => $c,
    	]);
    }

    
}
