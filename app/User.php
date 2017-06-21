<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public $appends = [
        "note"
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function ownJobs(){
      return $this->hasMany(Job::class,"job_owner");
    }
    public function workJobs(){
      return $this->hasMany(Job::class,"job_worker");
    }
    public function note(){
      return $this->workJobs->avg("note");
    }
    public function getNoteAttribute()
    {
      return $this->attributes["note"] = $this->note();
    }
    public function setPasswordAttribute($value){
      return $this->attributes["password"] = bcrypt($value);
    }
}
