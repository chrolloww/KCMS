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
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->string('c_name');
            $table->string('c_focal_person');
            $table->string('c_type')->default('LoI');
            $table->string('c_benefit');
            $table->string('c_start_date');
            $table->string('c_end_date');
            $table->string('c_description') -> nullable();
            $table->string('c_image') -> nullable();
            $table->string('c_status') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};
