<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <!-- Filtros -->
    <div class="row mb-4 justify-content-center">
        <div class="col-md-3">
            <label for="month" class="form-label">Mês:</label>
            <select id="month" class="form-select">
                <?php for($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo e($m); ?>" <?php echo e($m == $month ? 'selected' : ''); ?>>
                        <?php echo e(DateTime::createFromFormat('!m', $m)->format('F')); ?>

                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="year" class="form-label">Ano:</label>
            <select id="year" class="form-select">
                <?php for($y = now()->year; $y <= now()->year + 5; $y++): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e($y == $year ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>

    <!-- Calendário -->
    <div class="calendar-container">
        <div class="calendar">
            <!-- Cabeçalho com os dias da semana -->
            <div class="day-header">Dom</div>
            <div class="day-header">Seg</div>
            <div class="day-header">Ter</div>
            <div class="day-header">Qua</div>
            <div class="day-header">Qui</div>
            <div class="day-header">Sex</div>
            <div class="day-header">Sáb</div>

            <!-- Espaços vazios antes do primeiro dia do mês -->
            <?php for($i = 0; $i < $startDayOfWeek; $i++): ?>
                <div class="day-box empty"></div>
            <?php endfor; ?>

            <!-- Dias do mês -->
            <?php for($i = 1; $i <= $daysInMonth; $i++): ?>
                <?php
                    $reserva = $reservas[$i] ?? null;
                ?>
                <div class="day-box <?php echo e($reserva ? 'reserved' : 'empty-box'); ?>">
                    <span><?php echo e($i); ?></span>
                    <?php if($reserva): ?>
                        <?php $__currentLoopData = $reserva; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="reservation-info">
                                <strong>Finalidade:</strong> <?php echo e($r->finalidade); ?> <br>
                                <strong>Local:</strong> <?php echo e($r->local); ?> <br>
                                <strong>Observação:</strong> <?php echo e($r->observacao ?? 'Nenhuma'); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<style>
    .calendar-container {
        display: flex;
        justify-content: center;
    }
    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        width: 100%;
        max-width: 850px;
        text-align: center;
    }
    .day-header {
        font-weight: bold;
        text-transform: uppercase;
        padding: 10px;
        background-color: #f0f0f0;
        border-radius: 5px;
    }
    .day-box {
        width: 100px;
        height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border-radius: 8px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        padding: 10px;
        transition: transform 0.2s ease-in-out;
        background-color: #ddd;
        color: black;
    }
    .day-box:hover {
        transform: scale(1.05);
    }
    .empty { background: none; box-shadow: none; }
    .reserved { background-color: #dc3545; color: white; }
    .internal { background-color: #007bff; color: white; }
    .external { background-color: #ffc107; color: black; }
</style>

<script>
    document.getElementById("month").addEventListener("change", updateCalendar);
    document.getElementById("year").addEventListener("change", updateCalendar);

    function updateCalendar() {
        let month = document.getElementById("month").value;
        let year = document.getElementById("year").value;
        window.location.href = "<?php echo e(url('/calendario')); ?>?month=" + month + "&year=" + year;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\notes\resources\views/home.blade.php ENDPATH**/ ?>