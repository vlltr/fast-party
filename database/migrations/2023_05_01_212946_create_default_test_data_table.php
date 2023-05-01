<?php

use App\Models\Test;
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
        Schema::create('default_test_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Test::class)->constrained();
            $table->string('default_name');
            $table->decimal('max_value');
            $table->decimal('min_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_test_data');
    }
};
