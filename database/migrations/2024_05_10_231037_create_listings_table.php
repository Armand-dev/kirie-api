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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Landlord\Property::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\ListingPlatform::class);
            $table->string('platform_id')->nullable();
            $table->string('platform_category_id')->nullable();
            $table->string('status')->nullable();
            $table->string('status_info')->nullable();
            $table->string('status_css_class')->nullable();
            $table->string('url')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->string('title');
            $table->text('description');
            $table->float('price');
            $table->string('currency');
            $table->boolean('negotiable');
            $table->json('attributes');
            $table->json('images');
            $table->integer('views')->default(0);
            $table->integer('phone_views')->default(0);
            $table->integer('user_views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
