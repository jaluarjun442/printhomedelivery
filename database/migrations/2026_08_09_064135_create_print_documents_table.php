<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_documents', function (Blueprint $table) {
            $table->id();
            // Verified mobile number
            $table->string('mobile', 15)->index();

            // Original uploaded filename
            $table->string('original_name');

            // Actual stored filename/path
            $table->string('stored_path');

            // File information
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->default(0);

            $table->unsignedBigInteger('pages')->default(0);
            // Future use:
            // uploaded / printing / completed / failed
            $table->string('status')->default('uploaded');

            // Future order relation
            $table->unsignedBigInteger('order_id')->nullable()->index();

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
        Schema::dropIfExists('print_documents');
    }
}
