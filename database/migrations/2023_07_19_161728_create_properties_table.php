<?php

use App\Models\User;
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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('cost_of_acquisition')->nullable();
            $table->integer('rooms')->nullable();
            $table->integer('baths')->nullable();
            $table->decimal('area',6,2)->nullable();
            $table->integer('parking')->nullable();

            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('address')->nullable();

            $table->foreignIdFor(User::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
