<!DOCTYPE html>
<html>
<?php
$setting = App\Setting::first();
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Daftar | <?php echo e(App\Setting::first()->appname); ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->

    <!-- Meterial Icons Font Css -->
    <link href="<?php echo e(asset('ext/materialicon/material-icons.css')); ?>" rel="stylesheet"/>

    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('template/adminbsb/plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo e(asset('template/adminbsb/plugins/node-waves/waves.css')); ?>" rel="stylesheet">

    <!-- Animation Css -->
    <link href="<?php echo e(asset('template/adminbsb/plugins/animate-css/animate.css')); ?>" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?php echo e(asset('template/adminbsb/css/style.css')); ?>" rel="stylesheet">
</head>

<body class="signup-page">
<?php echo $__env->yieldContent('content'); ?>

<!-- Jquery Core Js -->
<script src="<?php echo e(asset('template/adminbsb/plugins/jquery/jquery.min.js')); ?>"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo e(asset('template/adminbsb/plugins/bootstrap/js/bootstrap.js')); ?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo e(asset('template/adminbsb/plugins/node-waves/waves.js')); ?>"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo e(asset('template/adminbsb/plugins/jquery-validation/jquery.validate.js')); ?>"></script>

<!-- Custom Js -->
<script src="<?php echo e(asset('template/adminbsb/js/admin.js')); ?>"></script>
<script src="<?php echo e(asset('template/adminbsb/js/pages/examples/sign-up.js')); ?>"></script>
</body>

</html><?php /**PATH D:\Projects\PHP\laraton\laravel\resources\views/layouts/registerbsb.blade.php ENDPATH**/ ?>
