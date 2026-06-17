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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('payment_method', 20); // pix, whatsapp
            $table->string('external_id', 255)->nullable(); // Mercado Pago reference
            $table->enum('status', ['pending', 'approved', 'rejected', 'canceled'])->default('pending');
            $table->decimal('amount', 10, 2);
            $table->text('pix_qr_code')->nullable();
            $table->string('pix_copy_paste', 500)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('response')->nullable();
            $table->timestamps();

            $table->index('order_id');
            $table->index('status');
            $table->index('external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
