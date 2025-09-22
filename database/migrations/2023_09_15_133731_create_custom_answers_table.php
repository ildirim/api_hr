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
        Schema::create('custom_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_question_id');
            $table->tinyInteger('is_correct')->default(0);
            $table->string('answer_text', 2000);

            $table->foreign('custom_question_id')->references('id')->on('custom_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_answers');
    }
};
