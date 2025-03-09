<?php $__env->startSection('content'); ?>
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
                                <?php echo csrf_field(); ?>
                                
                                <!-- Nome -->
                                <div class="mb-3">
                                    <label for="text_username" class="form-label">Nome</label>
                                    <input type="text" class="form-control bg-dark text-info" name="text_username" value="<?php echo e(old('text_username')); ?>" required>
                                    <?php $__errorArgs = ['text_username'];
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

                                <!-- E-mail -->
                                <div class="mb-3">
                                    <label for="text_email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control bg-dark text-info" name="text_email" value="<?php echo e(old('text_email')); ?>" required>
                                    <?php $__errorArgs = ['text_email'];
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

                                <!-- Senha -->
                                <div class="mb-3">
                                    <label for="text_password" class="form-label">Senha</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password" required>
                                    <?php $__errorArgs = ['text_password'];
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

                                <!-- Confirmar Senha -->
                                <div class="mb-3">
                                    <label for="text_password_confirmation" class="form-label">Confirmar Senha</label>
                                    <input type="password" class="form-control bg-dark text-info" name="text_password_confirmation" required>
                                    <?php $__errorArgs = ['text_password_confirmation'];
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

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-secondary w-100">CADASTRAR</button>
                                </div>
                            </form>

                            <!-- Mensagem de erro -->
                            <?php if(session('cadastroError')): ?>
                                <div class="alert alert-danger text-center">
                                    <?php echo e(session('cadastroError')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- copy -->
                    <div class="text-center text-secondary mt-3">
                       <a href="<?php echo e(route('login')); ?>">Logar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\notes\resources\views/cadastro.blade.php ENDPATH**/ ?>