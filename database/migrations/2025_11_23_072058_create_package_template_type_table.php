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
        Schema::create('package_template_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('template_type_id');
            $table->integer('count')->default(0);
            $table->integer('order')->default(0);

            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('template_type_id')->references('id')->on('template_types');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_template_type');
    }
};
