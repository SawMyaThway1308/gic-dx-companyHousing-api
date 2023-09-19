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
        Schema::create('t_address', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->integer('type');
            $table->date('use_start_date');
            $table->date('contract_end_date');
            $table->integer('rent');
            $table->integer('capacity');
            $table->integer('contract_type');
            $table->integer('status');
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
        Schema::dropIfExists('t_address');
    }
};
