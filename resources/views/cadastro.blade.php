@extends('layouts.main_layout')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5">
                    
                    <!-- logo -->
                    <div class="text-center p-3">
                        <h1>Cadastro</h1>
                    </div>

                    <!-- form -->
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <form action="/cadastroSubmit" method="post" novalidate>
                                @csrf
                                
                                <!-- Nome -->
                                <div class="mb-3">
                                    <label for="text_username" class="form-label">Nome</label>
                                    <input type="text" class="form-control bg-dark text-info" name="text_username" value="{{ old('text_username') }}" required>
                                    @error('text_username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- E-mail -->
                                <div class="mb-3">
                                    <label for="text_email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control bg-dark text-info" name="text_email" value="{{ old('text_email') }}" required>
                                    @error('text_email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Senha -->
                                <div class="mb-3">
                                    <label for="text_password" class="form-label">Senha</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password" required>
                                    @error('text_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirmar Senha -->
                                <div class="mb-3">
                                    <label for="text_password_confirmation" class="form-label">Confirmar Senha</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password_confirmation" required>
                                    @error('text_password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100">CADASTRAR</button>
                                </div>
                            </form>

                            <!-- Mensagem de erro -->
                            @if(session('cadastroError'))
                                <div class="alert alert-danger text-center">
                                    {{ session('cadastroError') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- copy -->
                    <div class="text-center text-secondary mt-3">
                       <a href="{{route('login')}}">Logar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
