<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class MAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'm_admin';
    protected $primaryKey = 'admin_id';

    public $timestamps = false;

    protected $fillable = [
        'admin_name',
        'password',
    ];

    protected $hidden = [
        'admin_pass',
        'password',
        'remember_token',
        'last_update',
        'delete_flag',
    ];


}
