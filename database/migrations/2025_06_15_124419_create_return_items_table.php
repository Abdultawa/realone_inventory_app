<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('invoice_item_id')->constrained('invoice_items')->onDelete('cascade');
            $table->integer('quantity_returned');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('reason');
            $table->foreignId('returned_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('returned_at')->useCurrent();
            $table->timestamps();

            $table->index(['invoice_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('return_items');
    }
};
