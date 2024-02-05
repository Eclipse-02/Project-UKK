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
        Schema::create('room_regs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('addon_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->date('checkin');
            $table->date('checkout');
            $table->string('promotion_code')->nullable();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->foreign('addon_id')->references('id')->on('room_addons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_regs');
    }
};
