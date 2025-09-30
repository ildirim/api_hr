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
            $table->unsignedBigInteger('questionable_id')->nullable();
            $table->string('questionable_type');
            $table->integer('duration')->default(0);
            $table->integer('order_number')->default(0);

            $table->foreign('template_category_id')->references('id')->on('template_categories');
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
