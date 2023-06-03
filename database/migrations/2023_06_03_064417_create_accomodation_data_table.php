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
        Schema::create('accomodation_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserData::class);
            $table->string('current_accommodation_status');
            $table->string('property_location');
            $table->string('property_type');
            $table->double('monthly_rent');
            $table->smallInteger('total_rent_years');
            $table->date('expected_movein_date');
            $table->smallInteger('total_payback_months');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomodation_data');
    }
};
