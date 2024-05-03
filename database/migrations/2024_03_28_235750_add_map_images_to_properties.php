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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('map_image')->default(asset('storage/property_placeholder.jpeg'));
            $table->string('street_view_image')->default(asset('storage/property_placeholder.jpeg'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('map_image');
            $table->dropColumn('street_view_image');
        });
    }
};
