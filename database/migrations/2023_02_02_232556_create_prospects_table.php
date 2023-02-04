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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('name');            
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();            
            $table->string('estate')->nullable();
            $table->string('city')->nullable();
            $table->string('commercial_business')->nullable();
            $table->string('observations')->nullable();
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('prospects');
    }
};
