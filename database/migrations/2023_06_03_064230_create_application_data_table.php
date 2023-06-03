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
            $table->string('first_name');
            $table->string('surname');
            $table->string('others_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('marital_status');
            $table->string('current_location');
            $table->string('whatsapp_number');
            $table->string('social_media_handles');
            $table->string('employment_status');
            $table->double('monthly_net_income');
            $table->string('company_name');
            $table->double('outstanding_loan');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_number');
            $table->string('emergency_contact_relation');
            $table->string('emergency_contact_location');
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
