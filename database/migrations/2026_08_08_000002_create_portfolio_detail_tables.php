<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('portfolio_details')) {
            Schema::create('portfolio_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('portfolio_item_id')->constrained()->cascadeOnDelete();
                $table->string('page_title')->default('Portfolio Details');
                $table->string('breadcrumb_title')->default('Portfolio Details');
                $table->string('project_title');
                $table->string('category')->nullable();
                $table->string('client')->nullable();
                $table->string('company')->nullable();
                $table->string('college')->nullable();
                $table->string('project_date')->nullable();
                $table->text('technologies')->nullable();
                $table->string('project_url')->nullable();
                $table->string('project_url_label')->nullable();
                $table->string('slider_style')->nullable();
                $table->string('image_style')->nullable();
                $table->string('info_style')->nullable();
                $table->string('description_title')->nullable();
                $table->longText('description')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('portfolio_detail_images')) {
            Schema::create('portfolio_detail_images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('portfolio_detail_id')->constrained()->cascadeOnDelete();
                $table->string('image');
                $table->unsignedInteger('width')->nullable();
                $table->unsignedInteger('height')->nullable();
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_detail_images');
        Schema::dropIfExists('portfolio_details');
    }
};
