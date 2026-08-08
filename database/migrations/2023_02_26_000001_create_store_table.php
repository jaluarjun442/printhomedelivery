<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('website_url')->nullable();
            $table->string('email')->nullable();
            $table->string('tag_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment')->nullable();
            $table->string('pan_card')->nullable();
            $table->text('about_us_tag')->nullable();
            $table->string('status')->default('inactive')->comment('active,inactive')->nullable();
            $table->text('header_script')->nullable();
            $table->text('sidebar_script')->nullable();
            $table->text('footer_script')->nullable();
            $table->string('red_tim')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store');
    }
}
