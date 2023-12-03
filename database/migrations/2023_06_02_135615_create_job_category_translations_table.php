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
        Schema::create('job_category_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_category_id');
            $table->unsignedBigInteger('language_id');
            $table->string('name');

            $table->foreign('job_category_id')->references('id')->on('job_categories')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_category_translations');
    }
};
