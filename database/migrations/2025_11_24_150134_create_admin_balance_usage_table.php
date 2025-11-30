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
        Schema::create('admin_balance_usage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('admin_balance_id')->nullable();
            $table->unsignedBigInteger('template_id')->nullable()->comment('The created template ID');
            $table->unsignedBigInteger('template_type_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('admin_balance_id')->references('id')->on('admin_balances')->onDelete('set null');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('set null');
            $table->foreign('template_type_id')->references('id')->on('template_types')->onDelete('set null');

            $table->index(['admin_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_balance_usage');
    }
};
