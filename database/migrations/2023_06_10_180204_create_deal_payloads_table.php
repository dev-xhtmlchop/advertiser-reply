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
        Schema::create('deal_payloads', function (Blueprint $table) {
            $table->id();
            $table->index('deal_id');
            $table->foreignId('deal_id')->references('id')->on('deals');
            $table->index('campaign_id');
            $table->foreignId('campaign_id')->references('id')->on('campaigns');
            $table->string('name');
            $table->string('deal_unit')->nullable();
            $table->string('demo')->nullable();
            $table->string('ae')->nullable();
            $table->string('demo_population')->nullable();
            $table->string('impressions')->nullable();
            $table->string('grp')->nullable();
            $table->string('cpm')->nullable();
            $table->integer('hh_rating')->nullable();
            $table->integer('hh_ss')->nullable();
            $table->integer('hh_cpm')->nullable();
            $table->integer('hh_univ')->nullable();
            $table->integer('a25_49_rating')->nullable();
            $table->integer('a25_49_ss')->nullable();
            $table->integer('a25_49_cpm')->nullable();
            $table->integer('a25_49_univ')->nullable();
            $table->dateTime('flight_start_date', 0);
            $table->dateTime('flight_end_date', 0);
            $table->boolean('sunday')->nullable();
            $table->boolean('monday')->nullable();
            $table->boolean('tuesday')->nullable();
            $table->boolean('wednesday')->nullable();
            $table->boolean('thursday')->nullable();
            $table->boolean('friday')->nullable();
            $table->boolean('saturday')->nullable();
            $table->integer('sunday_split')->nullable();
            $table->integer('monday_split')->nullable();
            $table->integer('tuesday_split')->nullable();
            $table->integer('wednesday_split')->nullable();
            $table->integer('thursday_split')->nullable();
            $table->integer('friday_split')->nullable();
            $table->integer('saturday_split')->nullable();
            $table->string('inventory_type')->nullable();
            $table->integer('inventory_length')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('rc_rate')->nullable();
            $table->integer('rc_rate_percentage')->nullable();
            $table->integer('total_avil')->nullable();
            $table->integer('total_unit')->nullable();
            $table->integer('unit')->nullable();
            $table->string('created_throught')->nullable();
            $table->integer('tape_id')->nullable();
            $table->string('change_by')->nullable();
            $table->string('change_throught')->nullable();
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
        Schema::dropIfExists('deal_payloads');
    }
};
