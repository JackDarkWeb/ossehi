<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "galleries";

    protected $guarded = [];

    public $timestamps = true;


    /**
     * Get the owning gallerizable model.
     */
    public function gallerizable()
    {
        return $this->morphTo();
    }
}
