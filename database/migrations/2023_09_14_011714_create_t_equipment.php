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
        Schema::create('t_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_name');
            $table->year('purchase_year');
            $table->string('maker');
            $table->string('model');
            $table->integer('status');
            $table->integer('address_id');
            $table->date('registration_date');
            $table->time('registration_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_equipment');
    }
};
