<?php

use App\Enum\PropertyFieldType;
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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', EnumFields::getColumn(PropertyFieldType::class));
            $table->string('unit')->nullable();
            $table->foreignId('property_type_id')->references('id')->on('property_types')->onDelete('cascade');
            $table->boolean('is_top')->default(0);
            $table->boolean('is_filter')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
