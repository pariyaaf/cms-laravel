<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Article;
use App\Models\Course;
use App\Models\ActivationCode;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        if(is_string($role)) {
            return $this->roles->contains('name' , $role);
        }


        return !! $role->intersect($this->roles)->count();
    }

    public function isAdmin(){
        // $level = $this->level;
        
        // if($level == 'admin') {
        //     return true;
        // }
        
        // return false;
        return $this->level == 'admin' ? true : false;
    }

    public function activationCode() {
        return $this->hasMany(activationCode::class);
    }

    
}
