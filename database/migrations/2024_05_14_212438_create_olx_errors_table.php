<?php

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
        Schema::create('olx_errors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Landlord\Property::class)->nullable();
            $table->foreignIdFor(\App\Models\Landlord\Listing::class)->nullable();
            $table->string('method')->nullable();
            $table->string('url')->nullable();
            $table->json('payload')->nullable();
            $table->integer('response_status')->nullable();
            $table->json('response')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olx_errors');
    }
};
