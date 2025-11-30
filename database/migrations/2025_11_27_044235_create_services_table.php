<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->decimal('tax_percentage', 5, 2)->nullable(); // e.g., 15.50%
            $table->decimal('shipping_installation_cost', 10, 2)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
