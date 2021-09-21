<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->nullable();
            $table->string('description')->nullable();;
            $table->string('code')->unique();
            $table->decimal('purchase_price')->default(0);
            $table->decimal('sale_price')->default(0);
            $table->decimal('purchase_price_duplicate')->default(0);
            $table->decimal('sale_price_duplicate')->default(0);
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('zip_codes');
    }
}
