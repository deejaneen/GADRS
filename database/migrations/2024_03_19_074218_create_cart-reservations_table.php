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
        Schema::create('gym_carts', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_number')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->date('reservation_date');
            $table->time('reservation_time_start');
            $table->time('reservation_time_end');
            $table->string('occupant_type');
            $table->string('office')->nullable();
            $table->string('office_address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('purpose')->nullable();
            $table->integer('number_of_courts')->nullable();
            $table->string('or_number')->nullable();
            $table->date('or_date')->nullable();
            $table->string('status')->default('Pending')->nullable();
            $table->float('price')->nullable()->default(600.00);
            $table->timestamps();

            // Add the foreign key constraint
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_carts');
    }
};
