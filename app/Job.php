<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Geocoder;

class Job extends Model
{
    // public $fillable = ["*"];
    public $guarded = ["id"];
  public static function boot()
  {
    
    static::saving(function($job){
      if($job->location != null)
      {
        $job->geo_location = json_encode(Geocoder::getCoordinatesForQuery($job->location));
      }
    });
  }
    public function getGeoLocationAttribute()
    {
      return json_deecode($this->geo_location);
    }
    public function owner()
    {
      return $this->belongsTo(User::class,"id","job_owner");
    }
    public function worker()
    {
      return $this->belongsTo(User::class,"id","job_worker");
    }
}
