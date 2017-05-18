<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // public $fillable = ["*"];
    public $protected = [];
    public function owner()
    {
      return $this->belongsTo(User::class,"id","job_owner");
    }
    public function worker()
    {
      return $this->belongsTo(User::class,"id","job_worker");
    }
}
