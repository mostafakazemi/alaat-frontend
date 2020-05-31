<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'block_id', 'pic', 'title', 'content', 'author_pic', 'author_name'
    ];
}
