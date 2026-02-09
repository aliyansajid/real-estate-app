<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->string('title');
            $table->text('description');
            $table->float('area');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->string('garage')->default('no');
            $table->integer('garage_count')->nullable();
            $table->year('year_built');
            $table->enum('purpose', ['rent', 'sale']);
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('price_per_month', 10, 2)->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->enum('property_type', ['house', 'apartment', 'commercial', 'villa', 'land', 'others']);
            $table->json('images')->nullable();
            $table->string('video_link')->nullable();
            $table->string('location_link')->nullable();
            $table->json('features')->nullable();
            
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->timestamp('inactive_at')->nullable();

            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
