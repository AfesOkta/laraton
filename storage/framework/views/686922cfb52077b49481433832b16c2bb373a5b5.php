<?php
    $setting = App\Setting::first();
?>
<?php $__env->startSection('content'); ?>
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"><?php echo e($setting->appname); ?></a>
        <small><?php echo e($setting->subname); ?></small>
    </div>
    <div class="card">
        <div class="body">
            <?php echo e(Form::open(['url'=>'login'])); ?>

                <?php echo csrf_field(); ?>
                <div class="msg">Masukkan email dan password.</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line<?php echo e($errors->has('email') ? ' error' : ''); ?>">
                        <?php echo e(Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Email', 'required'=>'required', 'autofocus'])); ?>

                    </div>
                    <?php if($errors->has('email')): ?>
                        <?php echo e(Form::label('email', $errors->first('email'), ['id'=>'email-error', 'class'=>'error'])); ?>

                    <?php endif; ?>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line<?php echo e($errors->has('email') ? ' error' : ''); ?>">
                        <?php echo e(Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password', 'required'=>'required'])); ?>

                    </div>
                    <?php if($errors->has('password')): ?>
                        <?php echo e(Form::label('password', $errors->first('password'), ['id'=>'password-error', 'class'=>'error'])); ?>

                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <?php echo e(Form::checkbox('remember', 1, old('remember') ? true : false, ['class'=>'filled-in chk-col-green'])); ?>

                        <label for="rememberme">Ingat Saya</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-green waves-effect" type="submit">LOGIN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="<?php echo e(route('register')); ?>">Daftar Sekarang!</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="<?php echo e(route('password.request')); ?>">Lupa Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.loginbsb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laraton\resources\views/auth/login.blade.php ENDPATH**/ ?>