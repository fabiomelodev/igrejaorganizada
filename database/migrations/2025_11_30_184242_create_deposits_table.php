<?php

use App\Models\Bank;
use App\Models\Category;
use App\Models\Member;
use App\Models\PaymentMethod;
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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('value', 10, 2);
            $table->date('date');
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Bank::class);
            $table->foreignIdFor(Member::class)->nullable();
            $table->foreignIdFor(PaymentMethod::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
