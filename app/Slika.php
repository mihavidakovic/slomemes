<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slika extends Model
{
	protected $fillable = [
        'naslov', 'user_id', 'url',
    ];
	protected $table = "slike";


    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function glas()
    {
        return $this->hasOne('App\Glas');
    }
    public function glasovi()
    {
        return $this->hasMany('App\Glas', 'post_id');
    }
    public function upvoti()
    {
        return $this->hasMany('App\Glas', 'post_id')->where('type', 1);
    }
    public function downvoti()
    {
        return $this->hasMany('App\Glas', 'post_id')->where('type', 0);
    }
    public function komentarji()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }
    public function scopeOrderByVotes($query)
    {
        $query->leftJoin('glasovi', 'glasovi.post_id', '=', 'slike.id')
            ->selectRaw('slike.*, count(glasovi.post_id) as aggregate')
            ->groupBy('slike.id')
            ->orderBy('aggregate', 'desc');
    }
}
