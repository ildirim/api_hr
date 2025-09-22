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
        Schema::create('template_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('question_category_id')->nullable();
            $table->boolean('is_grouped')->default(false);
            $table->integer('duration')->default(0);
            $table->integer('order_no')->default(0);
            $table->timestamps();

            $table->foreign('template_id')->references('id')->on('templates');
            $table->foreign('question_category_id')->references('id')->on('question_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_categories');
    }
};
