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
        Schema::table('template_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('question_category_id')->after('template_id');

            $table->foreign('question_category_id')->references('id')->on('question_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_categories', function (Blueprint $table) {
            $table->dropForeign('template_categories_question_category_id_foreign');
            $table->dropColumn('question_category_id');
        });
    }
};
