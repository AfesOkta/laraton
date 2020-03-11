<?php $__env->startSection('content'); ?>
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                <form action="<?php echo e(route('password.email')); ?>" id="forgot_password" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="msg">
                        Masukkan Email yang anda daftarkan, kami akan mengirimkan link untuk me-reset password ke email
                        anda.
                    </div>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                        <div class="form-line<?php echo e($errors->has('email') ? ' error' : ''); ?>">
                            <input type="email" class="form-control" name="email" placeholder="Email" required
                                   autofocus>
                        </div>
                        <?php if ($errors->has('email')): ?>
                            <label class="error" for="email"
                                   id="email-error"><?php echo e($errors->first('email')); ?></label>
                        <?php endif; ?>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Kirim Link</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="<?php echo e(url('login')); ?>">Login!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.loginbsb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\PHP\laraton\laravel\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>
