<?php

use App\Models\UserData;
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
        Schema::create('application_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserData::class);
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('others_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('current_location')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('social_media_handles')->nullable();
            $table->string('employment_status')->nullable();
            $table->double('monthly_net_income')->nullable();
            $table->string('company_name')->nullable();
            $table->string('outstanding_loan')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->string('emergency_contact_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_data');
    }
};
