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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('image');
            $table->decimal('price1',8,2);
            $table->decimal('price2',8,2);
            $table->decimal('price3',8,2);
            $table->decimal('price4',8,2);
            $table->smallInteger('status_id')->default(1);
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
        Schema::dropIfExists('product_galleries');
        Schema::dropIfExists('product_sheet_descriptions');
        Schema::dropIfExists('product_sheet_contents');
        Schema::dropIfExists('product_sheet_specifications');
        Schema::dropIfExists('products');
    }
};
