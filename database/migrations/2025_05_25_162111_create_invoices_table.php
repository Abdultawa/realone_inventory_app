<?php

use App\Models\Store;
use App\Models\User;
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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_number')->unique();
        $table->string('customer_name');
        $table->string('customer_address')->nullable();
        $table->text('notes')->nullable();
        $table->enum('status', ['paid', 'not-paid'])->default('not-paid');
        $table->foreignIdFor(User::class)->onDelete('cascade');
        $table->foreignId('store_id')->onDelete('cascade');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
