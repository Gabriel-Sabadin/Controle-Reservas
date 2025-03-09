@extends('layouts.main_layout')

@include('top_bar')

@section('content')
<div class="container mt-4">
    <h3 class="text-center mb-4">Histórico de Reservas</h3>

    <!-- Tabela -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Finalidade</th>
                    <th>Data e Hora de Início</th>
                    <th>Data e Hora de Término</th>
                    <th>Interno/Externo</th>
                    <th>Responsável</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemplo de reservas -->
                @foreach ($reservas as $reserva)
                <tr>
                    <td>{{$reserva->finalidade}}</td>
                    <td>{{$reserva->horario_inicio}}</td>
                    <td>{{$reserva->horario_termino}}</td>
                    <td>{{$reserva->local}}</td>
                    <td>{{$reserva->user}}</td>
                    <td>{{$reserva->observacao}}</td>
                </tr>  
                @endforeach
                
               
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Centralizando a tabela */
    .table-responsive {
        max-width: 90%;
        margin: 0 auto;
        border-radius: 20px; /* Aumentando o raio para bordas mais arredondadas */
        overflow: hidden;
    }

    table {
        font-size: 0.9rem;
        text-align: center;
        border-radius: 20px; /* Aumentando o raio para bordas mais arredondadas */
    }

    th, td {
        vertical-align: middle;
    }

    /* Estilo para o cabeçalho da tabela */
    thead.table-dark {
        background-color: #343a40;
        color: white;
    }

    th {
        font-weight: bold;
        padding: 12px 15px; /* Espaçamento no cabeçalho */
    }

    td {
        padding: 10px 15px; /* Espaçamento nas células */
    }

    /* Efeito de hover para as linhas */
    tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
</style>

@endsection
    