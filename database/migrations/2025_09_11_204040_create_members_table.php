<?php

use App\Models\Position;
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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender', ['masculine', 'feminine'])->default('masculine');
            $table->boolean('is_active')->default(1);
            $table->foreignIdFor(Team::class);
            $table->foreignIdFor(Position::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
