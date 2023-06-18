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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->index('advertiser_id')->nullable();
            $table->foreignId('advertiser_id')->references('id')->on('advertisers');
            $table->string('login_access_token')->unique();
            $table->enum('role', ['advertiser', 'broadcaster']);
            $table->string('user_name')->unique();
            $table->string('email_address')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('vadit_from')->nullable();
            $table->date('vadit_till')->nullable();
            $table->rememberToken();
            $table->string('image')->nullable();
            $table->boolean('login_access_status')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('delete')->default(0);
            $table->char('created_by', 255);
            $table->char('updated_by', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
