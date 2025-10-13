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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('template_type_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('job_subcategory_id');
            $table->integer('passing_type_code')->nullable();
            $table->integer('passing_score')->default(0); // ne ile olmalidi. faiz, dogru cavab sayi?
            $table->integer('timing_code')->nullable();
            $table->integer('duration')->default(0);
            $table->string('name');
            $table->string('url')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('template_type_id')->references('id')->on('template_types');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('job_subcategory_id')->references('id')->on('job_subcategories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
