<div class="row mb-3 align-items-center">
    <div class="col">
        <a href="<?php echo e(route('calendario')); ?>">
            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Notes logo" class="img-fluid w-25 pt-3">

        </a>
    </div>
    
    <div class="col text-center">
        <a href="<?php echo e(route('calendario')); ?>" class="text-decoration-none fw-bold text-info me-3">Home</a>
        <a href="<?php echo e(route('minhas')); ?>" class="text-decoration-none fw-bold text-info me-3">Minhas Reservas</a>
        <a href="<?php echo e(route('todas')); ?>" class="text-decoration-none fw-bold text-info me-3">Todas as Reservas</a>
    </div>

    <div class="col">
        <div class="d-flex justify-content-end align-items-center">
            <a href="<?php echo e(route('dados')); ?>">
                <span class="me-3 text-light">
                    <i class="fa-solid fa-user-circle fa-lg text-info me-2"></i><?php echo e(session('username')); ?>

                </span>
            </a>
            <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger px-3 pr-2">
                Logout<i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
            </a>
        </div>
    </div>
</div>

<hr class="border-secondary">
<?php /**PATH C:\laragon\www\notes\resources\views/top_bar.blade.php ENDPATH**/ ?>