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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street_name')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->mediumInteger('zip_code')->nullable();
            $table->enum('status', ['inflight' , 'approved', 'proposal', 'ordered', 'planning', 'ended', 'expired'] );
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
        Schema::dropIfExists('clients');
    }
};
