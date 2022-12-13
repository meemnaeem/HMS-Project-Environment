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
        Schema::create('roleaccesses', function (Blueprint $table) {
            $table->id();
            $table->string('can_create')->default('yes');
            $table->string('can_delete')->default('yes');
            $table->string('can_export')->default('yes');
            $table->string('can_import')->default('yes');
            $table->string('can_read')->default('yes');
            $table->string('can_update')->default('yes');
            $table->string('module')->default(0);
            $table->string('role_name')->default('user');
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
        Schema::dropIfExists('roleaccesses');
    }
};
