<?php

use App\Enum\PropertyItemType;
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
        Schema::create('property_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', EnumFields::getColumn(PropertyItemType::class));
            $table->string('value')->nullable();
            $table->string('unit')->nullable();
            $table->foreignId('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreignId('property_type_id')->references('id')->on('property_types')->onDelete('cascade');
            $table->boolean('is_top')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_items');
    }
};
