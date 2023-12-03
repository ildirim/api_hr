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
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('job_subcategory_id');
            $table->integer('duration')->default(0);
            $table->integer('plan_code');
            $table->integer('timing_code')->nullable();
            $table->string('name');
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins');
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
