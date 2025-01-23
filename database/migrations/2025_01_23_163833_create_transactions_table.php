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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id")->nullable();
            $table->string("transaction_uuid")->unique();
            $table->string("status")->default("pending")->default("pending")->comment("options: Pending ,Processing,Confirmed,Failed,Refunded,Disputed,Cancelled,On_Hold");
            $table->decimal("amount",8,2);
            $table->decimal("total_amount",8,2);
            $table->decimal("tax_amount",8,2);
            $table->decimal("service_charge",8,2);
            $table->decimal("delivery_charge",8,2);
            $table->string("signature");
            $table->text("failure")->nullable();
            $table->text("extra")->nullable();
            $table->json("extraJson")->nullable();
            $table->softDeletesDatetime();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
