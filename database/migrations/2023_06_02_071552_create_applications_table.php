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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserData::class);
            $table->enum('application_type', ['NEW', 'RENEW'])->default('NEW');
            $table->string('application_remark')->nullable();
            $table->string('admin_remark')->nullable();
            $table->string('application_code', 10)->unique();
            $table->foreignId('subadmin_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
