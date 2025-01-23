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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id")->nullable();
            $table->string("transaction_uuid")->unique();
            $table->string("status")->default("pending")->comment("options: Pending ,Processing,Confirmed,Failed,Refunded,Disputed,Cancelled,On_Hold")->default("pending");
            $table->decimal("amount" ,2,false);
            $table->decimal("total_amount" ,2,false);
            $table->decimal("tax_amount" ,2,false);
            $table->decimal("service_charge" ,2,false);
            $table->decimal("delivery_charge" ,2,false);
            $table->text("extra")->nullable();
            $table->json("extra")->nullable();
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
