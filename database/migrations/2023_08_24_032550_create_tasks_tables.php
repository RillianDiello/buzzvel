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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('description', 50);
            $table->string('attachment')->nullable();
            $table->unsignedBigInteger('task_status_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('task_status_id')->references('id')->on('task_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
