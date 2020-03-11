<?php $__env->startSection('content'); ?>
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST">
                    <?php echo e(Form::open(['url' => 'register'])); ?>

                    <div class="msg">Register a new membership</div>
                    <?php echo $__env->make('common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                        <div class="form-line<?php echo e($errors->has('name') ? ' error' : ''); ?>">
                            <?php echo e(Form::text('name', old('name'), ['placeholder' => 'Nama User', 'class' => 'form-control', 'required' => 'required', 'autofocus'])); ?>

                        </div>
                        <?php if ($errors->has('name')): ?>
                            <label id="name-error" class="error"
                                   for="name"><?php echo e($errors->first('name')); ?></label>
                        <?php endif; ?>
                    </div>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                        <div class="form-line<?php echo e($errors->has('fullname') ? ' error' : ''); ?>">
                            <?php echo e(Form::text('fullname', old('fullname'), ['placeholder' => 'Nama Lengkap', 'class' => 'form-control', 'required' => 'required', 'autofocus'])); ?>

                        </div>
                        <?php if ($errors->has('fullname')): ?>
                            <label id="fullname-error" class="error"
                                   for="fullname"><?php echo e($errors->first('fullname')); ?></label>
                        <?php endif; ?>
                    </div>
                    <div class="form-group form-float">
                        <input type="radio" name="gender" id="male" class="with-gap" value="m">
                        <label for="male">Laki-laki</label>
                        <input type="radio" name="gender" id="female" class="with-gap" value="f">
                        <label for="female" class="m-l-20">Perempuan</label>
                    </div>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                        <div class="form-line<?php echo e($errors->has('email') ? ' error' : ''); ?>">
                            <?php echo e(Form::email('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                        <?php if ($errors->has('email')): ?>
                            <label id="email-error" class="error"
                                   for="email"><?php echo e($errors->first('email')); ?></label>
                        <?php endif; ?>
                    </div>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                        <div class="form-line<?php echo e($errors->has('password') ? ' error' : ''); ?>">
                            <?php echo e(Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                        <?php if ($errors->has('password')): ?>
                            <label id="password-error" class="error"
                                   for="password"><?php echo e($errors->first('password')); ?></label>
                        <?php endif; ?>
                    </div>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                        <div class="form-line">
                            <?php echo e(Form::password('password_confirmation', ['placeholder' => 'Password Lagi', 'class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                    <div class="input-group">
                        <?php echo e(Form::checkbox('terms', 'terms', 0, ['class' => 'filled-in chk-col-pink form-control', 'id' => 'terms'])); ?>

                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of
                                usage</a>.</label>
                        <?php if ($errors->has('term')): ?>
                            <label id="term-error" class="error"
                                   for="term"><?php echo e($errors->first('term')); ?></label>
                        <?php endif; ?>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">DAFTAR</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="<?php echo e(route('login')); ?>">Sudah punya Akun?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.registerbsb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\PHP\laraton\laravel\resources\views/auth/register.blade.php ENDPATH**/ ?>
