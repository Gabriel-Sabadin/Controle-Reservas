

<?php echo $__env->make('top_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">
                
                <!-- Título -->
                <div class="text-center p-3">
                    <h2>Adicionar Reserva</h2>
                </div>

                <!-- Formulário -->
                <form action="<?php echo e(route('adicionarBanco')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" value="<?php echo e(session('user.id')); ?>">
                    <input type="hidden" name="day" value="<?php echo e($day); ?>">
                    <input type="hidden" name="month" value="<?php echo e($month); ?>">
                    <input type="hidden" name="year" value="<?php echo e($year); ?>">

                    
                    <!-- Finalidade -->
                    <div class="mb-3">
                        <label for="finalidade" class="form-label">Finalidade</label>
                        <input type="text" class="form-control" name="finalidade" value="<?php echo e(old('finalidade')); ?>" required>
                        <?php $__errorArgs = ['finalidade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Horário de Início -->
                    <div class="mb-3">
                        <label for="horario_inicio" class="form-label">Horário de Início</label>
                        <input type="time" class="form-control" name="horario_inicio" value="<?php echo e(old('horario_inicio')); ?>" required>
                        <?php $__errorArgs = ['horario_inicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <!-- Horário de Fim -->
                    <div class="mb-3">
                        <label for="horario_fim" class="form-label">Horário de Fim</label>
                        <input type="time" class="form-control" name="horario_fim" value="<?php echo e(old('horario_fim')); ?>" required>
                        <?php $__errorArgs = ['horario_fim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Interno/Externo -->
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-control" name="tipo" required>
                            <option value="">Selecione</option>
                            <option value="interno" <?php echo e(old('tipo') == 'interno' ? 'selected' : ''); ?>>Interno</option>
                            <option value="externo" <?php echo e(old('tipo') == 'externo' ? 'selected' : ''); ?>>Externo</option>
                        </select>
                        <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Observações -->
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control" name="observacoes" rows="3"><?php echo e(old('observacoes')); ?></textarea>
                        <?php $__errorArgs = ['observacoes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\notes\resources\views/adicionar.blade.php ENDPATH**/ ?>