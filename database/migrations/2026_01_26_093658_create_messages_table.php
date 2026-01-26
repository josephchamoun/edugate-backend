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
Schema::create('messages', function (Blueprint $table) {
$table->id();
$table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
$table->unsignedBigInteger('sender_id');
$table->string('sender_type');
$table->unsignedBigInteger('receiver_id');
$table->string('receiver_type');
$table->string('status');
$table->timestamp('published_at')->nullable();
$table->text('message_text');
$table->string('attachment')->nullable();
$table->string('subject')->nullable();
$table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
