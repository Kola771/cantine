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
        Schema::create('admin_entreprises', function (Blueprint $table) {
            $table->id();
            $table->longText("entreprise_name")->nullable();
            $table->string("admin_lastname");
            $table->string("admin_firstname");
            $table->string("licence_year")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_entreprises');
    }
};
