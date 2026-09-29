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
        Schema::table('bookings', function (Blueprint $table) {
            // Payment fields
            $table->decimal('deposit_amount', 15, 2)->default(0)->after('total_price');
            $table->decimal('remaining_balance', 15, 2)->default(0)->after('deposit_amount');
            $table->string('payment_status')->default('unpaid')->after('remaining_balance'); // unpaid, deposit_requested, deposit_paid, fully_paid, cancelled

            // Xendit readiness fields
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->text('payment_link_url')->nullable()->after('payment_method');
            $table->string('xendit_invoice_id')->nullable()->after('payment_link_url');
            $table->string('xendit_payment_status')->nullable()->after('xendit_invoice_id');
            $table->json('webhook_response')->nullable()->after('xendit_payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'deposit_amount',
                'remaining_balance',
                'payment_status',
                'payment_method',
                'payment_link_url',
                'xendit_invoice_id',
                'xendit_payment_status',
                'webhook_response',
            ]);
        });
    }
};
