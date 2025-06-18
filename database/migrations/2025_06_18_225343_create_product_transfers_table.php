<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('from_store_id')->constrained('stores')->onDelete('cascade');
            $table->foreignId('to_store_id')->constrained('stores')->onDelete('cascade');
            $table->integer('quantity');
            $table->text('reason')->nullable();
            $table->foreignId('transferred_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('transferred_at')->useCurrent();
            $table->timestamps();

            $table->index(['product_id', 'from_store_id', 'to_store_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_transfers');
    }
};
