@extends('layouts.main_layout')

@include('top_bar')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">
                
                <!-- Título -->
                <div class="text-center p-3">
                    <h2>Meus Dados</h2>
                </div>

                <!-- Formulário   route('meus-dados.atualizar') }}-->
                <form action="{{route('dadosSubmit')}}" method="post">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="text_name" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="text_name" value="{{ old('text_name', $usuario->name )}}" required>
                        @error('text_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- E-mail -->
                    <div class="mb-3">
                        <label for="text_email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="text_email" value="{{ old('text_email', $usuario->email) }}" required>
                        @error('text_email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="text_password" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" name="text_password">
                        @error('text_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="text_password_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" name="text_password_confirmation">
                        @error('text_password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botão -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Atualizar Dados</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
