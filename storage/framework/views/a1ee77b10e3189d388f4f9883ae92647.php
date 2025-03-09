<?php echo $__env->make('top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <!-- Filtros -->
    <div class="row mb-4 justify-content-center">
        <div class="col-md-3">
            <label for="month" class="form-label">Mês:</label>
            <select id="month" class="form-select" onchange="filterCalendar()">
                <?php
                $meses = [
                    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
                ];
            ?>
            
            <?php for($m = 1; $m <= 12; $m++): ?>
                <option value="<?php echo e($m); ?>" <?php echo e($m == $month ? 'selected' : ''); ?>>
                    <?php echo e($meses[$m]); ?>

                </option>
            <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="year" class="form-label">Ano:</label>
            <select id="year" class="form-select" onchange="filterCalendar()">
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
        // Pegando as reservas do dia específico
        $reserva = $reservas[$i] ?? null;
        $reservaUrl = route('adicionarReserva', [
            'user_id' => session('user.id'),
            'day' => $i,
            'month' => $month,
            'year' => $year
        ]);
    ?>

    <div class="day-box <?php echo e($reserva ? 'reserved' : 'empty-box'); ?>">
        <div class="day-number">
            <span><?php echo e($i); ?></span> <!-- Centraliza o número do dia -->
        </div>

        <?php if($reserva): ?>
            <!-- Para dias com reservas, exibe as informações das reservas -->
            <?php $__currentLoopData = $reserva; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="reservation-info">
                     <?php echo e($r->finalidade); ?> <br>
                     <?php echo e($r->local); ?> <br>
                     <?php echo e($r->horario_inicio); ?> <br>
                     <?php echo e($r->horario_termino); ?> <br>
                     <?php echo e($r->observacao ?? 'Nenhuma observação'); ?>

                </div>
                
                <!-- Verifica se o usuário logado é o dono da reserva -->
                <?php if($r->id_user == $userId): ?>
                <a href="<?php echo e(route('editar', [
                    'id' => $r->id,
                    'finalidade' => $r->finalidade,
                    'horario_inicio' => $r->horario_inicio,
                    'horario_fim' => $r->horario_termino,
                    'tipo' => $r->local,
                    'observacao' => $r->observacao ?? ''
                ])); ?>" class="reservation-link">
                    <span>Editar Reserva</span>
                </a>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <!-- Se não houver reserva, cria um link para adicionar uma reserva -->
            <a href="<?php echo e($reservaUrl); ?>" class="reservation-link">
                
            </a>
        <?php endif; ?>
    </div>
<?php endfor; ?>

        </div>
    </div>
</div>

<style>
/* Container do Calendário */
.calendar-container {
    display: flex;
    justify-content: center;
    margin-top: 20px; /* Espaçamento superior para o calendário */
}

/* Grade do Calendário */
.calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr); /* Dividindo em 7 colunas */
    gap: 15px; /* Aumenta o espaço entre as caixas dos dias */
    width: 100%;
    max-width: 1000px; /* Limita a largura máxima da grade */
    text-align: center;
}

/* Cabeçalho dos Dias da Semana */
.day-header {
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px;
    background-color: #f0f0f0;
    border-radius: 5px;
}

/* Estilo da Caixa de Cada Dia */
.day-box {
    width: 120px; /* Largura das caixas */
    height: 120px; /* Altura fixa para todas as caixas */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; /* Alinha o conteúdo ao centro */
    font-weight: bold;
    border-radius: 8px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    padding: 10px; /* Espaçamento interno das caixas */
    transition: transform 0.2s ease-in-out;
    background-color: #ddd;
    color: black;
    overflow: hidden; /* Impede que o conteúdo ultrapasse o limite da caixa */
}

/* Estilo para caixas de dias vazios */
.empty { 
    background: none; 
    box-shadow: none; 
}

/* Estilo para as caixas reservadas */
.reserved { 
    background-color: #dc3545;
    color: white;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 5px;
    margin-top: 5px;
    height: 100%; /* Garante que a caixa reservada ocupe toda a altura disponível */
}

/* Estilo para as caixas de dias internos */
.internal { 
    background-color: #007bff; 
    color: white;
}

/* Estilo para as caixas de dias externos */
.external { 
    background-color: #ffc107; 
    color: black;
}

/* Link de Reserva (Apenas para os dias disponíveis) */
.reservation-link {
    text-decoration: none;
    color: inherit;
    display: block;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Caixa de dia disponível */
.empty-box {
    background-color: #28a745; /* Verde para indicar que está disponível */
    color: white;
}

/* Efeito de hover para a caixa de dia disponível */
.empty-box:hover {
    background-color: #218838;
    transform: scale(1.05);
}

/* Informações de Reserva */
.reservation-info {
    font-size: 12px;
    text-align: left;
    margin-top: 5px;
    padding: 5px;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    width: 100%;
    max-height: none;
    white-space: normal;
    overflow: visible;
}

/* Estilo para informações de reserva em negrito */
.reservation-info strong {
    font-weight: bold;
}


</style>



<script>
    function filterCalendar() {
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var url = new URL(window.location.href);
        
        // Adiciona ou atualiza os parâmetros de mês e ano na URL
        url.searchParams.set('month', month);
        url.searchParams.set('year', year);
        
        // Redireciona para a nova URL
        window.location.href = url.toString();
    }

    // Esse código já vai lidar com a atualização de mês e ano
    document.addEventListener("DOMContentLoaded", function () {
        // Caso o mês ou ano não estejam na URL, ele vai ajustar para o mês e ano atuais
        let urlParams = new URLSearchParams(window.location.search);
        let month = urlParams.get("month");
        let year = urlParams.get("year");

        if (!month || !year) {
            let currentMonth = new Date().getMonth() + 1;
            let currentYear = new Date().getFullYear();
            window.location.href = "<?php echo e(url('/calendario')); ?>?month=" + currentMonth + "&year=" + currentYear;
        }
    });
</script>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\notes\resources\views/index.blade.php ENDPATH**/ ?>