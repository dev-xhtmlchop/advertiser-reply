<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->timestamp('user_logged_in_timestamp')->nullable();
            $table->timestamp('user_logged_out_timestamp')->nullable();
            $table->string('ip_address')->nullable();
            $table->char('created_by', 255);
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_histories');
    }
};
