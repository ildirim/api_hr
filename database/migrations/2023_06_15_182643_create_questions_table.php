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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_subcategory_id');
            $table->unsignedBigInteger('question_category_id');
            $table->tinyInteger('question_level');
            $table->integer('duration')->default(0);
            $table->enum('type', \App\Http\Enums\QuestionTypeEnum::cases());
            $table->timestamps();

            $table->foreign('job_subcategory_id')->references('id')->on('job_subcategories');
            $table->foreign('question_category_id')->references('id')->on('question_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
