<?php

namespace App\Models;

use App\Models\Rol;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //relacion uno a uno con rol
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    //hashear todos los password previo a su almacenamiento en la bd
    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }
    //relacion muchos a muchos entre tag, post y user
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function isAdmin()
    {
        return $this->rol->key == 'ROL_ADMIN';
    }
    
}
