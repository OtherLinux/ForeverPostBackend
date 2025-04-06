<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //
    /**
     * @var array
     */

    protected $table = "posts";

    protected $attributes = [
        'display_name'=> "Anonymous",
        'message'=> '',
        'nsfw'=> false,
        'hidden'=> false,
    ];

    protected $dateFormat = "U";

    protected $hidden = ['hidden'];
}
