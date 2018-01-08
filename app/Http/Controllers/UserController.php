<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slika;
use App\User;
use App\Glas;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Http\Resources\UporabnikoveSlikeCollection;
use Storage;

class UserController extends Controller
{
    public function profilGet($name) {
    	$user = User::where('name', '=', $name)->first();
    	$postiCount = Slika::where('user_id', '=', $user->id)->count();

    	return view('profil', ['user' => $user, 'postiCount' => $postiCount]);
    }
    public function profilGetLiked($name) {
    	$user = User::where('name', '=', $name)->first();
    	$posti = DB::table('slike')
    				->join('glasovi', 'slike.id', '=', 'glasovi.post_id')
    				->where('glasovi.type', '=', 1)
    				->get();

    	return response()->json($posti);
    }
 
    public function profilGetDisliked($name) {
    	$user = User::where('name', '=', $name)->first();
    	$posti = DB::table('slike')
    				->join('glasovi', 'slike.id', '=', 'glasovi.post_id')
    				->where('glasovi.type', '=', 2)
    				->get();

    	return response()->json($posti);
    }

    public function profilUrediGet() {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            return view('uredi-profil', ['user' => $user]);
        }
        return redirect()->route('domov');
    }
    public function profilUrediPost(Request $request) {
        if (Auth::check()) {
             $this->validate($request, [
                'forum_podpis' => 'max:100',
                'avatar' => 'mimes:jpeg,bmp,png|max:5000'
            ]);
            $user = User::find(Auth::user()->id);
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store(
                    'avatars/'.$request->user()->id, 's3'
                );
                $user->avatar = Storage::disk("s3")->url($path);
            }
            $user->forum_podpis = $request->input('forum_podpis');
            $user->save();
            \Session::flash('flash_message','Spremembe uspešno shranjene.');
            return back();
        }
        return redirect()->route('domov');
    }

    public function profilUpdateProfilka(Request $request) {
        if (Auth::check()) {
            $this->validate($request, [
                'newAvatar' => 'mimes:jpeg,bmp,png|max:5000'
            ]);
            $user = User::find(Auth::user()->id);
            if ($request->hasFile('newAvatar')) {
                $path = $request->file('newAvatar')->store(
                    'avatars/'.$request->user()->id, 's3'
                );
                $user->avatar = Storage::disk("s3")->url($path);
                return response()->json(['success' => true]);
            }
        }
    }

    public function nalozeno($name) {
        $user = User::where('name', $name)->first();
        return new UporabnikoveSlikeCollection(Slika::withCount('komentarji')->withCount('upvoti')->withCount('downvoti')->where('user_id', '=', $user->id)->paginate(12));
    }

    public function uporabnikApi() {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
        } else {
            $user = [];
        }

        return $user;
    }

    public function uporabnik($username) {
        $user = User::withCount('slike')->where('name', $username)->first();

        return $user;
    }
}
