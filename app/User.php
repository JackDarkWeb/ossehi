<?php

namespace App;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Store;
use App\Models\Various;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password', 'notify',
        'location', 'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the comments for the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the stores for the user.
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Get the products for the user.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the products for the user.
     */
    public function variouses()
    {
        return $this->hasMany(Various::class);
    }

    /**
     * @return mixed|string
     */
    function getUserNameAttribute(){
        return $this->first_name ?: "Unknown{$this->id}";
    }

    /**
     * @return mixed|string
     */
    function getUserNameProfileAttribute(){
        return $this->first_name ?: "Unknown";
    }
}
