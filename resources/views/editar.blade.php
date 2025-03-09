@extends('layouts.main_layout')

@include('top_bar')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">
                
                <!-- Título -->
                <div class="text-center p-3">
                    <h2>Editar Reserva</h2>
                </div>

                <!-- Formulário -->
                <form action="{{route('editarSubmit')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ old('id', request('id')) }}">
                    <!-- Finalidade -->
                    <div class="mb-3">
                        <label for="finalidade" class="form-label">Finalidade</label>
                        <input type="text" class="form-control" name="finalidade" value="{{ old('finalidade', request('finalidade')) }}" required>
                        @error('finalidade')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Horário de Início -->
                    <div class="mb-3">
                        <label for="horario_inicio" class="form-label">Horário de Início</label>
                        <input type="time" class="form-control" name="horario_inicio" value="{{ old('horario_inicio', request('horario_inicio'))}}" required>
                        @error('horario_inicio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Horário de Fim -->
                    <div class="mb-3">
                        <label for="horario_fim" class="form-label">Horário de Fim</label>
                        <input type="time" class="form-control" name="horario_fim" value="{{ old('horario_fim', request('horario_fim')) }}" required>
                        @error('horario_fim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Interno/Externo -->
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-control" name="tipo" required>
                            <option value="">Selecione</option>
                            <option value="interno" {{ old('tipo', request('tipo')) == 'interno' ? 'selected' : '' }}>Interno</option>
                            <option value="externo" {{ old('tipo', request('tipo')) == 'externo' ? 'selected' : '' }}>Externo</option>
                        </select>
                        @error('tipo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Observações -->
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control" name="observacoes" rows="3">{{ old('observacoes', request('observacao')) }}</textarea>
                        @error('observacoes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botão de Atualizar -->
                    <div class="mb-3">
                        
                        <button type="submit" class="btn btn-primary w-100">Atualizar Reserva</button>
                    </div>

                    <!-- Botão de Excluir -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">Excluir</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir esta reserva? Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <form action="{{ route('apagarSubmit', ['id' => request()->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
