<?php if (count($errors) > 0): ?>
    <div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Whoops! ada yang salah!</strong>
        <br><br>
        <ul>
            <?php $__currentLoopData = $errors->all();
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $error): $__env->incrementLoopIndices();
                $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?><?php /**PATH D:\Projects\PHP\laraton\laravel\resources\views/common/errors.blade.php ENDPATH**/ ?>
