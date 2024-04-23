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
        Schema::create('dorm_carts', function (Blueprint $table) {
            $table->id();
            $table->string('Form_number')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->date('reservation_start_date');
            $table->time('reservation_start_time');
            $table->date('reservation_end_date');
            $table->time('reservation_end_time');
            $table->string('gender');
            $table->integer('quantity')->default(0);
            $table->string('occupant_type');
            $table->string('office')->nullable();
            $table->string('office_address')->nullable();
            $table->string('position')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('employee_number')->nullable();
            $table->string('id_presented')->nullable();
            $table->string('coa_or_non_coa_id')->nullable();
            $table->string('coa_referrer')->nullable();
            $table->string('coa_referrer_office')->nullable();
            $table->string('relationship_with_guest')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status')->default('OnCart')->nullable();
            $table->text('purpose_of_stay')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->text('home_address')->nullable();
            $table->string('discount_image')->nullable();
            $table->boolean('is_senior_or_pwd')->default(false);
            $table->boolean('is_child')->default(false);
            $table->string('form_group_number')->nullable();
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
        Schema::dropIfExists('dorm_carts');
    }
};
