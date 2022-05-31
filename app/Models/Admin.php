<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'admins';
    protected $guarded = array();

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'activation', 'image'];
}
