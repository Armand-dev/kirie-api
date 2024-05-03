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
        Schema::table('leases', function (Blueprint $table) {
            $table->string('rent_currency')->nullable();
            $table->string('deposit_currency')->nullable();
            $table->json('body')->change();
        });
        Schema::table('lease_templates', function (Blueprint $table) {
            $table->json('body')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leases', function (Blueprint $table) {
            $table->dropColumn('rent_currency');
            $table->dropColumn('deposit_currency');
        });
    }
};
