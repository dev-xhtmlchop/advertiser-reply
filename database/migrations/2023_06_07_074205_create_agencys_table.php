<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * agency_name
     */
    public function up(): void
    {
        Schema::create('agencys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street_name')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->mediumInteger('zip_code')->nullable();
            $table->integer('agency_commission')->nullable();
            $table->string('function')->nullable();
            $table->string('ae')->nullable();
            $table->index('media_id');
            $table->foreignId('media_id')->references('id')->on('medias');
            $table->index('demographic_id');
            $table->foreignId('demographic_id')->references('id')->on('demographics');
            $table->index('brand_id');
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->index('outlet_id');
            $table->foreignId('outlet_id')->references('id')->on('outlets');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('agencys');
    }
};
