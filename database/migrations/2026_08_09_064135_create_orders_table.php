<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->string('order_number')->unique();

            // Customer
            $table->string('mobile', 20);
            $table->string('full_name');
            $table->string('email');

            // Address
            $table->string('pincode', 6);
            $table->string('city');
            $table->string('state');
            $table->text('house');
            $table->text('road');
            $table->string('landmark')->nullable();

            // Shipping
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->string('courier_name')->nullable();
            $table->decimal('shipping_charge', 10, 2)->default(0);
            $table->string('delivery_estimate')->nullable();
            $table->decimal('weight', 10, 3)->nullable();

            // Pricing
            $table->decimal('print_subtotal', 10, 2)->default(0);
            $table->decimal('handling_charge', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);

            // Payment
            $table->string('payment_method')->default('cod');
            $table->string('payment_status')->default('pending');

            /*
    Future Razorpay:
    */
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();

            // Order data snapshot
            $table->json('items')->nullable();

            $table->string('status')->default('placed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
