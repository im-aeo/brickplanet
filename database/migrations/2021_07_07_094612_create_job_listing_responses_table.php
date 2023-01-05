<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_listing_responses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('listing_id')->unsigned();
            $table->bigInteger('applicant_id')->unsigned()->nullable();
            $table->bigInteger('reviewer_id')->unsigned()->nullable();
            $table->string('tracking_code')->unique();
            $table->string('status')->default('pending'); // pending, declined, accepted
            $table->string('name');
            $table->string('email');
            $table->text('why_work');
            $table->text('why_choose');
            $table->text('how_find');
            $table->timestamps();

            $table->foreign('listing_id')->references('id')->on('job_listings')->onDelete('cascade');
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_listing_responses');
    }
}
