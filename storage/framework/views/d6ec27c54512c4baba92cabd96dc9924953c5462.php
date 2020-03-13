<!DOCTYPE html>
<html>
<?php
    $setting = App\Setting::first();
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>404 | SKELETON - ADMINBSB</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo e(asset('template/adminbsb/favicon.ico')); ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('template/adminbsb/plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo e(asset('template/adminbsb/plugins/node-waves/waves.css')); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo e(asset('template/adminbsb/css/style.css')); ?>" rel="stylesheet">
</head>

<body class="four-zero-four" style="background-image: url('<?php echo e(asset('uploads/images/'.$setting->bg)); ?>'); background-repeat: no-repeat; background-size: cover;">
    <div style="position: absolute; top: 0; width: 100%; height: 100vh; opacity: 0.3; background-color: black;">
    </div>
    <div class="four-zero-four-container" style="position: relative;">
        <div class="error-code col-white">404</div>
        <div class="error-message col-cyan">Halamannya ga ketemu eung!!<br>Mungkin belum jadi :p</div>
        <div class="button-place">
            <a href="<?php echo e(url('/home')); ?>" class="btn btn-primary btn-lg waves-effect">PULANG!!</a>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo e(asset('template/adminbsb/plugins/jquery/jquery.min.js')); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo e(asset('template/adminbsb/plugins/bootstrap/js/bootstrap.js')); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo e(asset('template/adminbsb/plugins/node-waves/waves.js')); ?>"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\laraton\resources\views/errors/404.blade.php ENDPATH**/ ?>