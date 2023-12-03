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
        Schema::create('template_category_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_category_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('custom_question_id')->nullable();

            $table->foreign('template_category_id')->references('id')->on('template_categories');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('custom_question_id')->references('id')->on('custom_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_category_questions');
    }
};
