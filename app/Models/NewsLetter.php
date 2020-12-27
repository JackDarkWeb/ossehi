<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    public $timestamps = true;

    protected $table = "news_letters";

   protected $guarded = [];

    protected $casts = [
        'created_at',
        'updated_at',
    ];
}
