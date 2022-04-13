<?php

namespace App;

use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\HtmlString;
use Image;

class User extends Authenticatable
{

    use Notifiable,LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','email', 'password','image'
    ]; //end of fillable

    protected $appends = ['image_path']; // end of appends

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ]; // end of hidden

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; // end of casts

    public function getImagePathAttribute()
    {
       return asset('uploads/users_images/' . $this->image);
    } // end of getImagePathAttribute

} // end of model user

