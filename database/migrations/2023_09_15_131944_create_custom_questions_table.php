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
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('language_id');
            $table->integer('type');
            $table->string('content', 2000);
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('template_id')->references('id')->on('templates');
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
