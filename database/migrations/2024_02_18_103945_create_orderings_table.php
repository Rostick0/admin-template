<?php

use App\Enum\OrderingStatusType;
use App\Utils\EnumFields;
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
            $table->enum('status', EnumFields::getColumn(OrderingStatusType::class))->default(OrderingStatusType::draft);
            $table->float('price')->default(0);
            $table->string('reason')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
