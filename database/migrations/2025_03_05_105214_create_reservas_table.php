<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('reservas', function (Blueprint $table) {
        $table->id(); // Já cria a chave primária automaticamente
        $table->string('finalidade');
        $table->date('data')->nullable();
        $table->time('horario_inicio');
        $table->time('horario_termino');
        $table->string('local');
        $table->unsignedBigInteger('id_user'); // Alterado para unsignedBigInteger
        $table->string('user'); // Correção
        $table->text('observacao')->nullable(); // Melhor usar text para textos longos
        $table->integer('dia_reserva');
        $table->integer('mes_reserva');
        $table->integer('ano_reserva');
        $table->timestamps();

        // Adicionando chave estrangeira
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('reservas');
}

};