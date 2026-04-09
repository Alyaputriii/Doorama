<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('knock_patterns', function (Blueprint $table) {
            $table->bigIncrements('pattern_id');
            $table->unsignedBigInteger('user_id');
            $table->string('pattern_name', 100);
            $table->json('feature_data')->nullable();
            $table->decimal('threshold', 5, 2)->default(0.80);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knock_patterns');
    }
};