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
        Schema::create('deals', function (Blueprint $table) {
            $table->id()->startingValue(800000001);
            $table->index('advertiser_id')->nullable();
            $table->foreignId('advertiser_id')->references('id')->on('advertisers');
            $table->index('campaign_id');
            $table->foreignId('campaign_id')->references('id')->on('campaigns');
            $table->string('title');
            $table->dateTime('valid_from', 0);
            $table->dateTime('valid_to', 0);
            $table->year('deal_year');
            $table->index('media_id');
            $table->foreignId('media_id')->references('id')->on('medias');
            $table->index('demographic_id');
            $table->foreignId('demographic_id')->references('id')->on('demographics');
            $table->index('brand_id');
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->index('outlet_id');
            $table->foreignId('outlet_id')->references('id')->on('outlets');
            $table->index('agency_id');
            $table->foreignId('agency_id')->references('id')->on('agencys');
            $table->index('daypart_id');
            $table->foreignId('daypart_id')->references('id')->on('day_parts');
            $table->index('location_id');
            $table->foreignId('location_id')->references('id')->on('locations');
            $table->string('market_place')->nullable();
            $table->string('realistic')->nullable();
            $table->integer('revenue');
            $table->integer('rate');
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
        Schema::dropIfExists('deals');
    }
};
