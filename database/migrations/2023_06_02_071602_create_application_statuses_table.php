<?php

use App\Models\Application;
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
        Schema::create('application_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Application::class);
            $table->enum('application_status', ['INCOMPLETE', 'PENDING', 'UNDER_VERIFICATION', 'VERIFIED', 'APPROVED', 'REJECTED', 'LOAN_STARTED', 'LOAN_CLOSED'])->default('INCOMPLETE');
            $table->timestamps();
            $table->unique(['application_id', 'application_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_statuses');
    }
};
