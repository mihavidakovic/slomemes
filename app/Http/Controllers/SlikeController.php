<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slika;
use App\Glas;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Faker;
use App\Achievements\Normie;
use App\Achievements\MemeZacetnik;


class SlikeController extends Controller
{
    public function slike(Request $request) {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $slike = Slika::with('user')->withCount('upvoti')->withCount('downvoti')
            ->whereDoesntHave('glasovi', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })    
            ->take(20)
            ->get();
            return response()->json(['slike' => $slike])->withCallback($request->input('callback')); 
        }
    }
    public function slika($id, Request $request) {
            $slike = Slika::with('user')->withCount('upvoti')->withCount('downvoti')->where('id', '=', $id)->first();
            return response()->json(['slike' => $slike]); 
    }
    public function postiJSON(Request $request, $od, $do) {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $slike = Slika::with('user')
            ->whereDoesntHave('glasovi', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })            
            ->whereBetween('slike.created_at', array(Carbon::now()->subHours($od), Carbon::now()->subHours($do)))
            ->withCount('glasovi') 
            ->take(20)
            ->get();
            return response()->json(['slike' => $slike])->withCallback($request->input('callback')); 
        } else {
            $slike = Slika::with('user')
            ->whereBetween('slike.created_at', array(Carbon::now()->subHours(48), Carbon::now()))
            ->orderBy('slike.created_at', 'DESC')
            ->orderByVotes()
            ->withCount('glasovi') 
            ->take(20)
            ->get();
            return response()->json(['slike' => $slike])->withCallback($request->input('callback')); 
        }
	}

    public function vote($id) {
        if (Glas::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $id)->exists()) {
            return response()->json(['success' => false]);
        } else {
            $g = new Glas;
            $g->user_id = Auth::user()->id;
            $g->post_id = $id;
            $g->type = 1;
            $g->save();
            return response()->json(['success' => true]);
        }
    }
    public function downvote($id) {
        if (Glas::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $id)->exists()) {
            return response()->json(['success' => false]);
        } else {
            $g = new Glas;
            $g->user_id = Auth::user()->id;
            $g->post_id = $id;
            $g->type = 2;
            $g->save();
            return response()->json(['success' => true]);
        }
    }
    public function faker($num) {
		$faker = Faker\Factory::create();

		$velikosti = [400, 500, 600, 700, 800];
		$type = ['technics', 'cats', 'nature', 'abstract', 'animals', 'business', 'nightlife', 'food'];
		

	    for ($i = 0; $i < $num; $i++) {
			$width = array_rand($velikosti,1);
			$height = array_rand($velikosti,1);
			$rand_type = array_rand($type,1);
			$p = new Slika;
			$p->naslov = $faker->realText($maxNbChars = 120, $indexSize = 5);
			$p->url = $faker->imageUrl($velikosti[$width], $velikosti[$height], $type[$rand_type]);
			$p->user_id = Auth::user()->id;
            $user = User::find(Auth::user()->id);
            if ($user->rank == "9GAG podpornik") {
                $user->addProgress(new Normie(), 1);
            } elseif ($user->rank == "Normie") {
                $user->addProgress(new MemeZacetnik(), 1);
            }
			$p->save();
	    }
	    return 'Dodano ' . $num . ' objav';
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    // DODAJ MEME
    public function dodajGet() {
        return view('dodaj');
    }

    public function dodajPost(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'url' => 'required|url',
        ]);

        $p = new Slika;
        $p->naslov = $request->input('title');
        $p->url = $request->input('url');
        $p->user_id = Auth::user()->id;
        $p->save();

        $user = User::find(Auth::user()->id);
        if ($user->rank == "9GAG podpornik") {
            $user->addProgress(new Normie(), 1);
        } elseif ($user->rank == "Normie") {
            $user->addProgress(new MemeZacetnik(), 1);
        }

        return back();
    }


    // USTVARI MEME
    public function ustvariGet() {
        return view('ustvari');
    }

    public function ustvariPost(Request $request) {
        return response()->json($request);
    }

    // IZBRIŠI MEME
    public function memeDelete($id) {
        $m = Slika::find($id);
        $m->delete();
        return back();
    }

    // GLASOVANJE
    public function postUpvote($id) {
        $post = Slika::find($id);
        $glas = new Glas;
        $glas->user_id = Auth::user()->id;
        $glas->post_id = $id;
        $glas->type = 1;
        $glas->save();
        return response()->json(["id" => $id, "title" => $post->title]);

    }

    public function postDownvote($id) {
        $post = Slika::find($id);
        $glas = new Glas;
        $glas->user_id = Auth::user()->id;
        $glas->post_id = $id;
        $glas->type = 2;
        $glas->save();
        return response()->json(["id" => $id, "title" => $post->title]);

    }
}
