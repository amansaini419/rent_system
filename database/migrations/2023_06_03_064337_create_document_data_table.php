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
        Schema::create('document_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserData::class);
            $table->string('passport_picture_path');
            $table->string('ghana_card');
            $table->string('ghana_card_path');
            $table->string('statement_path');
            $table->string('employment_letter_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_data');
    }
};
