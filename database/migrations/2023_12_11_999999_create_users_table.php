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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('matricule')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('idRole')->nullable();
            $table->foreignId('idAdmin')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('idRole')->references('id')->on('roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('idAdmin')->references('id')->on('admin_entreprises')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
