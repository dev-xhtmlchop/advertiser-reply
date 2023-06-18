<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * demographic_id
     */
    public function up(): void
    {
        Schema::create('demographics', function (Blueprint $table) {
            $table->id();
            $table->boolean('primory');
            $table->string('name')->nullable();
            $table->boolean('print');
            $table->boolean('rating');
            $table->boolean('cpp');
            $table->boolean('share');
            $table->boolean('hutput');
            $table->boolean('impression');
            $table->boolean('cpm');
            $table->boolean('vph');
            $table->boolean('total_impression');
            $table->boolean('total_grp');
            $table->boolean('percentage_st');
            $table->index('location_id');
            $table->foreignId('location_id')->references('id')->on('locations');
            $table->index('outlet_id');
            $table->foreignId('outlet_id')->references('id')->on('outlets');
            $table->string('stewardship_method');
            $table->string('dat_stream_set');
            $table->string('universe_type');
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
        Schema::dropIfExists('demographics');
    }
};
