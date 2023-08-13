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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->decimal('price')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->date('installation_time')->nullable();
            $table->date('warranty_expiration')->nullable();
            $table->boolean('lifetime_warranty')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail_url')->nullable();

            $table->foreignIdFor(\App\Models\Landlord\EquipmentCategory::class);
            $table->foreignIdFor(\App\Models\Landlord\EquipmentSubcategory::class);
            $table->foreignIdFor(\App\Models\Landlord\Property::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
