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
Schema::create('announcements', function (Blueprint $table) {
$table->id();
$table->foreignId('admin_id')->constrained()->cascadeOnDelete();
$table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
$table->string('title');
$table->string('category');
$table->date('start_date');
$table->date('end_date');
$table->timestamp('publish_at')->nullable();
$table->text('description');
$table->string('attachment')->nullable();
$table->string('image_url')->nullable();
$table->string('targeted_audience');
$table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
