<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id');
            $table->date('work_date');
            $table->foreignId('user_id');
            $table->integer('active')->default(1);
            $table->string('file_name')->default(1);
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
        Schema::dropIfExists('file_headers');
    }
}
