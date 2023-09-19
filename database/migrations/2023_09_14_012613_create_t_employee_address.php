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
        Schema::create('t_employee_address', function (Blueprint $table) {
            $table->integer('address_id');
            $table->integer('employee_id');
            $table->date('movein_date');
            $table->date('moveout_date')->nullable();;
            $table->integer('living_type');
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
        Schema::dropIfExists('t_employee_address');
    }
};
