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
        Schema::create('admin_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('template_type_id');
            $table->integer('total_count')->default(0)->comment('Total templates from package');
            $table->integer('used_count')->default(0)->comment('Number of templates used');
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('template_type_id')->references('id')->on('template_types')->onDelete('cascade');

            $table->index(['admin_id', 'template_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_balances');
    }
};
