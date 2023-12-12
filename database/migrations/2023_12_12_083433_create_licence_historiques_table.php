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
        Schema::create('licence_historiques', function (Blueprint $table) {
            $table->id();
            $table->longText('enterprise_name');
            $table->enum("etat", ['achetee', 'modifiee']);
            $table->date("licence_year_start")->nullable();
            $table->date("licence_year_end")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licence_historiques');
    }
};
