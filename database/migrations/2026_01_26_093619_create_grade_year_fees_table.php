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
Schema::create('grade_year_fees', function (Blueprint $table) {
$table->id();
$table->foreignId('grade_year_id')->constrained()->cascadeOnDelete();
$table->float('total_amount');
$table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_year_fees');
    }
};
