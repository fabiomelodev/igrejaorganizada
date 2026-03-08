<?php

use App\Models\Member;
use App\Models\Responsible;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('is_internal')->default(true);
            $table->boolean('is_active')->default(true);
            $table->text('health_observations')->nullable();
            $table->json('health_reports')->nullable();
            $table->foreignIdFor(Member::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Responsible::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
