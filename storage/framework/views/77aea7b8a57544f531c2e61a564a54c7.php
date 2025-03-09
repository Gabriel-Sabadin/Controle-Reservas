<?php echo $__env->make('top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($reserva->finalidade); ?></td>
                    <td><?php echo e($reserva->horario_inicio); ?></td>
                    <td><?php echo e($reserva->horario_termino); ?></td>
                    <td><?php echo e($reserva->local); ?></td>
                    <td><?php echo e($reserva->user); ?></td>
                    <td><?php echo e($reserva->observacao); ?></td>
                </tr>  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
               
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

<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('layouts.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\notes\resources\views/reservas.blade.php ENDPATH**/ ?>