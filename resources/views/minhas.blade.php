@extends('layouts.main_layout')

@include('top_bar')

@section('content')
<div class="container mt-4">
    <h3 class="text-center">
        @if(request('filtro') == 'ativas')
            Minhas Reservas Ativas
        @else
            Todas Minhas Reservas
        @endif
    </h3>

    <!-- Filtro de Reservas -->
    <div class="d-flex justify-content-center mb-4">
        <button id="allReservations" class="btn btn-primary mx-2">Todas</button>
        <button id="activeReservations" class="btn btn-secondary mx-2">Ativas</button>
    </div>

    <!-- Tabela -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="reservationTable">
            <thead class="table-dark">
                <tr>
                    <th>Finalidade</th>
                    <th>Hora de Início</th>
                    <th>Hora de Término</th>
                    <th>Interno/Externo</th>
                    <th>Responsável</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody id="reservationBody">
                @forelse ($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->finalidade }}</td>
                        <td>{{ $reserva->horario_inicio }}</td>
                        <td>{{ $reserva->horario_termino }}</td>
                        <td>{{ $reserva->local }}</td>
                        <td>{{ $reserva->user }}</td>
                        <td>{{ $reserva->observacao }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhuma reserva encontrada</td>
                    </tr>
                @endforelse
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

    .btn {
        font-weight: bold;
        padding: 8px 16px;
    }
</style>

<script>
    document.getElementById("allReservations").addEventListener("click", function() {
        window.location.href = "{{ url('/minhas-reservas') }}?filtro=todas";
    });

    document.getElementById("activeReservations").addEventListener("click", function() {
        window.location.href = "{{ url('/minhas-reservas') }}?filtro=ativas";
    });
</script>

@endsection
