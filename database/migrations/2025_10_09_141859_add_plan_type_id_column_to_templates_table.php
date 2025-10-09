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
        Schema::table('templates', function (Blueprint $table) {
            $table->dropColumn('plan_code');
            $table->unsignedBigInteger('plan_type_id')->nullable()->after('job_subcategory_id');

            $table->foreign('plan_type_id')->references('id')->on('plan_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->integer('plan_code');
            $table->dropColumn('plan_type_id');
        });
    }
};
