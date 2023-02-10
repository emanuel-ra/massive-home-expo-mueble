<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sheet_sub_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('specifications_id');          
            $table->string('code'); 
            $table->longText('description');
            $table->unsignedBigInteger('module');
            $table->unsignedBigInteger('order_number');
            $table->timestamps();
            //$table->foreign('product_id')->references('id')->on('products'); 
            $table->foreign('specifications_id')->references('id')->on('product_sheet_specifications'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sheet_sub_specifications');
    }
};
