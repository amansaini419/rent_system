<?php

use App\Models\Invoice;
use App\Models\Loan;
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
        Schema::create('monthly_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Loan::class);
            $table->foreignIdFor(Invoice::class)->default(0);
            $table->date('due_date');
            $table->date('payment_date')->nullable();
            $table->double('penalty')->default(0);
            $table->string('tenant_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_plans');
    }
};
