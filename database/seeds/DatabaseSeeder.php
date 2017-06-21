<?php

use Illuminate\Database\Seeder;
use App\Job;
use App\User;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        "email"=>"user@karmajobs.com",
        "password"=>"password",
        "firstname"=>"USER",
        "lastname"=>"USER",
        "location"=>"Avenue de la gare 14\n1450 Ste-Croix"
      ]);
      User::create([
        "email"=>"another@karmajobs.com",
        "password"=>"password",
        "firstname"=>"USER",
        "lastname"=>"USER",
        "location"=>"Avenue de la gare 14\n1450 Ste-Croix"
      ]);
      User::create([
        "email"=>"yetagain@karmajobs.com",
        "password"=>"password",
        "firstname"=>"USER",
        "lastname"=>"USER",
        "location"=>"Avenue de la gare 14\n1450 Ste-Croix"
      ]);
      User::create([
        "email"=>"row@karmajobs.com",
        "password"=>"password",
        "firstname"=>"USER",
        "lastname"=>"USER",
        "location"=>"Avenue de la gare 14\n1450 Ste-Croix"
      ]);
      Job::create([
        "title"=>"My awesome job first",
        "start_at"=>Carbon::now("+5h"),
        "location"=>"Aenue des alpes 15\n 1450 Ste-Croix",
        "reward"=>"COOOOKIES",
        "category"=>"house keeping",
        "job_owner"=>4
      ]);
      collect(range(0,10))->each(function($i){

        $j = Job::create([
          "title"=>"My awesome job {$i}",
          "start_at"=>Carbon::now("+".(5+$i)."h"),
          "location"=>"Avenue des alpes 15\n 1450 Ste-Croix",
          "reward"=>"COOOOKIES",
          "category"=>"house keeping",
          "job_owner"=>rand(1,4)
        ]);
        if(rand(0,100) % 2){
          $j->end_at = Carbon::now("+1day");
          $j->save();
        }

      });
        // $this->call(UsersTableSeeder::class);
    }
}
