<?php

use App\Enum\StatusType;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('content');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
            $table->string('source')->nullable();
            $table->integer('count_view')->default(0);
            $table->enum('status', EnumFields::getColumn(StatusType::class))->default(StatusType::draft);
            $table->boolean('is_private')->default(0);
            $table->timestamp('date_publication')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
