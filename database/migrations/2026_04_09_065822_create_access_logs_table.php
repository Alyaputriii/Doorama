<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();

            $table->string('event_type', 100);
            $table->text('description')->nullable();
            $table->string('result', 50)->nullable();
            $table->integer('knock_count')->default(0);
            $table->decimal('ml_score', 5, 2)->nullable();
            $table->string('door_state', 50)->nullable();
            $table->string('lock_state', 50)->nullable();
            $table->string('system_mode', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('session_id')
                ->references('session_id')
                ->on('user_sessions')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};