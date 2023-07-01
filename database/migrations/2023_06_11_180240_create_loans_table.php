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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Application::class);
            $table->date('starting_date');
            $table->double('loan_amount');
            $table->double('interest_rate');
            $table->double('loan_period');
            $table->double('monthly_payment');
            $table->double('initial_deposit');
            $table->string('loan_code', 11);
            $table->enum('loan_status', ['OPENED', 'CLOSED'])->default('OPENED');
            $table->date('closed_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
