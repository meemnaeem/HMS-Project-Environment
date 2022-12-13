<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->text('website')->nullable();
            $table->text('icon')->nullable();
            $table->text('favicon')->nullable();
            $table->text('about')->nullable();
            $table->text('contact')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default("1")->comment('0, 1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
