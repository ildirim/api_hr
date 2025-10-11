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
        Schema::create('template_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('has_system_questions')->default(false);
            $table->integer('max_system_question_count')->default(0);
            $table->integer('max_custom_question_count')->default(0);
            $table->integer('passing_type_code');
            $table->integer('timing_code')->nullable();
            $table->boolean('has_shuffle_questions')->default(false);
            $table->boolean('max_shuffled_question_count')->default(0);
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_types');
    }
};
