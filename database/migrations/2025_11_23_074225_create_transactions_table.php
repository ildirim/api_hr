<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Enums\GatewayEnum;
use App\Http\Enums\TransactionTypeEnum;
use App\Http\Enums\TransactionStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('package_id');
            $table->string('operation_number', 50)->unique();
            $table->integer('gateway_order')->nullable();
            $table->string('gateway_password', 50)->nullable();
            $table->enum('gateway_code', GatewayEnum::caseValues())->nullable();
            $table->decimal('amount', 8, 2);
            $table->string('currency', 20);
            $table->enum('type', TransactionTypeEnum::caseValues())->nullable();
            $table->enum('status', TransactionStatusEnum::caseValues())->nullable();
            $table->json('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
