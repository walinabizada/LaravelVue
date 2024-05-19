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
        Schema::create('kbms', function (Blueprint $table) {
            $table->id();
            $table->string('service_name')->nullable();
            $table->string('implementation_side')->nullable();
            $table->string('time_frame')->nullable();
            $table->text('needed_document')->nullable();
            $table->string('fees')->nullable();
            $table->text('legal_document')->nullable();
            $table->text('implementation_procedures')->nullable();
            $table->string('course_of_action')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbms');
    }
};
