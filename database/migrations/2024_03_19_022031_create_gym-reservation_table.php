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
        Schema::create('gym-reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_number')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('form_number_id')->nullable(); // Make it nullable if you want
            $table->date('reservation_date');
            $table->time('reservation_time_start');
            $table->time('reservation_time_end');
            $table->string('occupant_type');
            $table->string('representative')->nullable();
            $table->string('office_address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('purpose')->nullable();
            $table->string('or_number')->nullable();
            $table->integer('number_of_courts')->nullable();
            $table->date('or_date')->nullable();
            $table->string('status')->default('Pending')->nullable();
            $table->decimal('price', 10, 2)->nullable()->default(600.00);
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('form_group_number')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('oop_number')->nullable();
            $table->timestamps();

            $table->foreign('form_number_id')->references('id')->on('form_numbers')->onDelete('set null');

            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym-reservations');
    }
};
