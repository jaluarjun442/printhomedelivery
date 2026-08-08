<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->float('price')->default('0.00')->nullable();
            $table->string('image')->nullable();
            $table->text('body')->nullable();
            $table->integer('views')->nullable();
            $table->integer('status')->default(1)->comment('0=inactive,1=active')->nullable();
            $table->text('comment')->nullable();
            $table->string('buy_now_text')->nullable();
            $table->text('buy_now_link')->nullable();
            $table->integer('au_red')->default(0)->comment('0=inactive,1=active')->nullable();
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
        Schema::dropIfExists('products');
    }
}
