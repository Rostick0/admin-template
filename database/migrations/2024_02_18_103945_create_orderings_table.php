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
        Schema::create('orderings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('date')->nullable();
            $table->string('address');
            $table->integer('user_id')->nullable();
            $table->enum('status', ['pending', 'canceled', 'draft', 'completed', 'rejected'])->default('draft');
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderings');
    }
};
