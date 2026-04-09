<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('config_change_logs', function (Blueprint $table) {
            $table->bigIncrements('change_id');
            $table->unsignedBigInteger('config_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();

            $table->string('field_name', 100);
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamp('changed_at')->useCurrent();

            $table->foreign('config_id')
                ->references('config_id')
                ->on('system_configs')
                ->onDelete('cascade');

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
        Schema::dropIfExists('config_change_logs');
    }
};