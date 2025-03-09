@extends('layouts.main_layout')

@include('top_bar')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">
                
                <!-- Título -->
                <div class="text-center p-3">
                    <h2>Adicionar Reserva</h2>
                </div>

                <!-- Formulário -->
                <form action="{{route('adicionarBanco')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ session('user.id') }}">
                    <input type="hidden" name="day" value="{{ $day }}">
                    <input type="hidden" name="month" value="{{ $month }}">
                    <input type="hidden" name="year" value="{{ $year }}">

                    
                    <!-- Finalidade -->
                    <div class="mb-3">
                        <label for="finalidade" class="form-label">Finalidade</label>
                        <input type="text" class="form-control" name="finalidade" value="{{ old('finalidade') }}" required>
                        @error('finalidade')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Horário de Início -->
                    <div class="mb-3">
                        <label for="horario_inicio" class="form-label">Horário de Início</label>
                        <input type="time" class="form-control" name="horario_inicio" value="{{ old('horario_inicio') }}" required>
                        @error('horario_inicio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Horário de Fim -->
                    <div class="mb-3">
                        <label for="horario_fim" class="form-label">Horário de Fim</label>
                        <input type="time" class="form-control" name="horario_fim" value="{{ old('horario_fim') }}" required>
                        @error('horario_fim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Interno/Externo -->
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-control" name="tipo" required>
                            <option value="">Selecione</option>
                            <option value="interno" {{ old('tipo') == 'interno' ? 'selected' : '' }}>Interno</option>
                            <option value="externo" {{ old('tipo') == 'externo' ? 'selected' : '' }}>Externo</option>
                        </select>
                        @error('tipo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Observações -->
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control" name="observacoes" rows="3">{{ old('observacoes') }}</textarea>
                        @error('observacoes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botão -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Adicionar Reserva</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
