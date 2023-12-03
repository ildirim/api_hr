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
        Schema::create('custom_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('template_category_id');
            $table->unsignedBigInteger('language_id');
            $table->string('content', 2000);
            $table->timestamps();

            $table->foreign('template_category_id')->references('id')->on('template_categories');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_questions');
    }
};
