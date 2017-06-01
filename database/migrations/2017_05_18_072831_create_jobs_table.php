<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("job_owner");
            $table->unsignedInteger("job_worker")->nullable();

            $table->datetime("start_at");
            $table->datetime("end_at")->nullable();
            $table->string("title");
            $table->string("reward")->nullable();
            $table->string("category");
            $table->string("location");
            $table->string("geo_location")->nullable();
            $table->integer("note")->nullable();


            $table->timestamps();
            $table->foreign("job_owner")
                  ->references("id")->on("users")
                  ->onDelete("cascade");
            $table->foreign("job_worker")
                  ->references("id")->on("users")
                  ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
