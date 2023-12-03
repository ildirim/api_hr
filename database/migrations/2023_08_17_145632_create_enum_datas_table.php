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
        Schema::create('enum_datas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enum_type_id');
            $table->string('name');
            $table->integer('code');
            $table->timestamps();

            $table->foreign('enum_type_id')->references('id')->on('enum_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enum_datas');
    }
};
