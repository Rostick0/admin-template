<?php

use App\Enum\StatisticType;
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
        Schema::create('statistic_days', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->unsigned()->default(0);
            $table->enum('type', EnumFields::getColumn(StatisticType::class));
            $table->morphs('stat_relatsable');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistic_days');
    }
};
