<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Geocoder;

class Job extends Model
{
    // public $fillable = ["*"];
    public $guarded = ["id"];
    public $appends = ["geo_location"];
  public static function boot()
  {

    static::saving(function($job){
      if($job->location != null)
      {
        $job->geo_location = Geocoder::getCoordinatesForQuery($job->location);
      }
    });
  }
    public function getGeoLocationAttribute($val)
    {
      return json_decode($val,true);
    }
    public function setGeoLocationAttribute($val)
    {
      $this->attributes["geo_location"] = json_encode($val);
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
