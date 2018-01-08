<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glas extends Model
{
	protected $fillable = [
        'post_id', 'user_id', 'type',
    ];
	protected $table = "glasovi";
}
