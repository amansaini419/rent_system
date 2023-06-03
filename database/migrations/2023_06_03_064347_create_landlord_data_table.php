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
        Schema::create('landlord_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserData::class);
            $table->string('landlord_name');
            $table->string('landlord_number');
            $table->string('landlord_address');
            $table->string('landlord_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landlord_data');
    }
};
