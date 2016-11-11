<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenges';

    protected $fillable = ['user1_id', 'user2_id', 'state'];
}
