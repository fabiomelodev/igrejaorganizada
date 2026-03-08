<?php

use App\Models\Frequency;
use App\Models\Participant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frequency_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Frequency::class);
            $table->foreignIdFor(Participant::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequency_participants');
    }
};
