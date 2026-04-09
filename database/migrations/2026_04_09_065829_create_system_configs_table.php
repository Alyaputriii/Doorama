<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_configs', function (Blueprint $table) {
            $table->bigIncrements('config_id');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->integer('failed_attempt_limit')->default(3);
            $table->integer('debounce_time')->default(500);
            $table->integer('config_mode_timeout')->default(60);
            $table->string('softap_ssid', 100)->nullable();
            $table->integer('knock_timeout')->default(5);
            $table->integer('lockout_duration')->default(30);
            $table->timestamps();

            $table->foreign('updated_by')
                ->references('user_id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_configs');
    }
};