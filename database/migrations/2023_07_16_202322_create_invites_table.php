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
        Schema::create('invites', function (Blueprint $table) {
            $table->ulid('id');
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->foreignId('event_id');
            $table->boolean('is_attending')->default(false);
            $table->boolean('has_responded')->default(false);
            $table->integer('number_attending')->default(0);
            $table->string('comments')->nullable();
            $table->boolean('is_invite_sent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
