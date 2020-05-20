<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('material_type_id');
            $table->integer('priority');
            $table->integer('start_time')->nullable();
            $table->integer('end_time')->nullable();
            $table->timestamps();
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('material_type_id')->references('id')->on('material_types')->onDelete('cascade');
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
