<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Remove 'autoincement()', pois não existe
            $table->string('name', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->dateTime('last_login')->nullable(); // Corrigido 'nullabe()' para 'nullable()'
            $table->timestamps();
            $table->softDeletes(); // Corrigido 'softdeletes()' para 'softDeletes()'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};  