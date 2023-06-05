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
            $table->string('current_accommodation_status')->nullable();
            $table->string('property_location')->nullable();
            $table->string('property_type')->nullable();
            $table->double('monthly_rent')->nullable();
            $table->smallInteger('total_rent_years')->nullable();
            $table->date('expected_movein_date')->nullable();
            $table->smallInteger('total_payback_months')->nullable();
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
