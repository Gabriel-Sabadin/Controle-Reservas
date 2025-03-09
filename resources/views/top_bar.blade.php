<div class="row mb-3 align-items-center">
    <div class="col">
        <a href="{{ route('calendario') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Notes logo" class="img-fluid w-25 pt-3">

        </a>
    </div>
    
    <div class="col text-center">
        <a href="{{ route('calendario') }}" class="text-decoration-none fw-bold text-info me-3">Home</a>
        <a href="{{ route('minhas')}}" class="text-decoration-none fw-bold text-info me-3">Minhas Reservas</a>
        <a href="{{route('todas')}}" class="text-decoration-none fw-bold text-info me-3">Todas as Reservas</a>
    </div>

    <div class="col">
        <div class="d-flex justify-content-end align-items-center">
            <a href="{{route('dados')}}">
                <span class="me-3 text-light">
                    <i class="fa-solid fa-user-circle fa-lg text-info me-2"></i>{{ session('username') }}
                </span>
            </a>
            <a href="{{ route('logout') }}" class="btn btn-danger px-3 pr-2">
                Logout<i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
            </a>
        </div>
    </div>
</div>

<hr class="border-secondary">
