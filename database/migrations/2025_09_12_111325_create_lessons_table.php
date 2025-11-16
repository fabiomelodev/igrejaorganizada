<?php

use App\Models\Member;
use App\Models\School;
use App\Models\Team;
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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('period', ['quarter', 'not_defined'])->default('not_defined');
            $table->enum('time', ['night', 'afternoon', 'morning', 'not_defined'])->default('not_defined');
            $table->enum('progress', ['finished', 'paused', 'course', 'preparing'])->default('preparing');
            $table->boolean('status')->default(1);
            $table->foreignIdFor(Team::class);
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(Member::class, 'teacher_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
