<?php $__env->startSection('title', 'GROUP'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>Daftar Grup</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-primary waves-effect pull-right" id="add">TAMBAH
                            </button>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable"
                           id="group-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Grup</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama Grup</th>
                            <th>Aksi</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $__currentLoopData = $groups;
                        $__env->addLoop($__currentLoopData);
                        foreach ($__currentLoopData as $group): $__env->incrementLoopIndices();
                            $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($group->id); ?></td>
                                <td>
                                    <a onclick="fill_menu('<?php echo e($group->id); ?>', '<?php echo e($group->name); ?>');"
                                       style="cursor: pointer;"
                                       id="group<?php echo e($group->id); ?>"><?php echo e($group->name); ?></a></td>
                                <td align="center"><a href="#" title="edit"
                                                      onclick="edit_group('<?php echo e($group->id); ?>', '<?php echo e($group->name); ?>')"><i
                                                class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a href="#"
                                                                                                                title="hapus"
                                                                                                                onclick="delete_group('<?php echo e($group->id); ?>', '<?php echo e($group->name); ?>')"><i
                                                class="glyphicon glyphicon-trash"></i></a></td>
                            </tr>
                        <?php endforeach;
                        $__env->popLoop();
                        $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2 id="manage-group">
                        Hak Akses Menu
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <input type="hidden" name="group_id" id="group_id">
                            <?php $__currentLoopData = $menus;
                            $__env->addLoop($__currentLoopData);
                            foreach ($__currentLoopData as $menu): $__env->incrementLoopIndices();
                                $loop = $__env->getLastLoop(); ?>
                                <input type="checkbox" value="<?php echo e($menu['id']); ?>"
                                       id="menu<?php echo e($menu['id']); ?>"
                                       class="chk-col-green filled-in checkbox-group" name="menu"/>
                                <label for="menu<?php echo e($menu['id']); ?>"
                                       class="checkbox_menu level0"><?php echo e($menu['title']); ?></label>
                                <?php list_menu_box($menu, 0); ?>
                            <?php endforeach;
                            $__env->popLoop();
                            $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-sm-12">
                            <div id="buttons">
                                <button type="button" class="btn btn-primary m-t-15 waves-effect pull-right" id="save">
                                    SIMPAN
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style type="text/css">
        .checkbox_menu {
            display: block !important;
        }

        .level0 {
            margin-left: 0px;
        }

        .level1 {
            margin-left: 30px;
        }

        .level2 {
            margin-left: 60px;
        }

        .level3 {
            margin-left: 90px;
        }
    </style>
    <!-- JQuery DataTable Css -->
    <link href="<?php echo e(asset('template/adminbsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')); ?>"
          rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo e(asset('template/adminbsb/plugins/jquery-datatable/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('template/adminbsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#group_id').val('');
            $('.checkbox-group').removeAttr('checked');
        });
        $(function () {
            $('.js-basic-example').DataTable({
                responsive: true
            });

            $('#save').on('click', function () {
                var menus = [];
                $("input[name='menu']:checked").each(function () {
                    menus.push($(this).val());
                });
                var id = $("#group_id").val();
                if (id == '') {
                    swal("Eitss!!", "Pilih dulu Grupnya dong!! :)", "error");
                } else {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        data: {_token: '<?php echo e(csrf_token()); ?>', menus: menus, id: id},
                        url: "<?php echo e(url('/group/save')); ?>",
                        success: function (data) {
                            $.each(data.info, function (i, d) {
                                if (d.status == 'success') {
                                    showAlert(d.message, 'bg-green');
                                } else {
                                    showAlert(d.message, 'bg-red');
                                }
                            })
                            console.log(data);
                            $('.checkbox-group').removeAttr('checked');
                            $.each(data.menus, function (i, d) {
                                $('#menu' + d).prop('checked', true);
                            })
                            showAlert(data.message, 'bg-blue');
                        },
                        error: function (data) {
                            showAlert('Error: ' + data, 'bg-red');
                            console.log(data);
                        }
                    });
                }
            });

            $('#add').on('click', function () {
                swal({
                    title: "Tambah Grup!",
                    text: "Mau tambah grup apa?",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Nama Grup"
                }, function (inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("Jangan dikosongin dong!");
                        return false
                    }
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        data: {_token: '<?php echo e(csrf_token()); ?>', name: inputValue},
                        url: "<?php echo e(url('/group/add_group')); ?>",
                        success: function (data) {
                            if (data.status == 'success') {
                                console.log(data);
                                swal("Berhasil!", data.message, "success");
                                var table = '<tr>' +
                                    '<td>' + data.id + '</td>' +
                                    '<td><a onclick="fill_menu(\'' + data.id + '\', \'' + data.name + '\');" style="cursor: pointer;" id="group' + data.id + '">' + data.name + '</a></td>' +
                                    '<td align="center"><a href="#" title="edit" onclick="edit_group(\'' + data.id + '\', \'' + data.name + '\')"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a href="#" title="hapus" onclick="delete_group(\'' + data.id + '\', \'' + data.name + '\')"><i class="glyphicon glyphicon-trash"></i></a></td>' +
                                    '</tr>';
                                $('#group-table tbody').append(table);
                            } else {
                                swal("Yaaaahh!", data.message, "error");
                            }
                        },
                        error: function (data) {
                            showAlert('Error: ' + data, 'bg-red');
                            console.log(data);
                        }
                    });
                });
            });
        });

        var fill_menu = function (id, name) {
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {_token: '<?php echo e(csrf_token()); ?>', id: id},
                url: "<?php echo e(url('/group/fill_menu')); ?>",
                success: function (data) {
                    $('.checkbox-group').removeAttr('checked');
                    $('#group_id').val(id);
                    $('#manage-group').html('Hak Akses Menu untuk <strong>"' + name + '"</strong>');
                    $.each(data, function (i, d) {
                        $('#menu' + d).prop('checked', true);
                    })
                },
                error: function (data) {
                    showAlert('Error: ' + data, 'bg-red');
                    console.log(data);
                }
            });
        }

        var edit_group = function (id, name) {
            swal({
                title: "Edit Grup!",
                text: "Mau ganti nama jadi apa?",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Nama Grup",
                inputValue: name
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("Jangan dikosongin dong!");
                    return false
                }
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {_token: '<?php echo e(csrf_token()); ?>', id: id, name: inputValue},
                    url: "<?php echo e(url('/group/edit_group')); ?>",
                    success: function (data) {
                        if (data.status == 'success') {
                            swal("Berhasil!", data.message, "success");
                        } else {
                            swal("Yaaaahh!", data.message, "error");
                        }
                    },
                    error: function (data) {
                        showAlert('Error: ' + data, 'bg-red');
                        console.log(data);
                    }
                });
            });
        }

        var delete_group = function (id, name) {
            swal({
                title: "Yakin?",
                text: "Grup " + name + "-nya mau di hapus?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus aja!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: {_token: '<?php echo e(csrf_token()); ?>', id: id},
                    url: "<?php echo e(url('/group/delete_group')); ?>",
                    success: function (data) {
                        if (data.status == 'success') {
                            swal("Terhapus!", data.message, "success");
                            setInterval(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            swal("Yaaahh!", data.message, "error");
                        }
                    },
                    error: function (data) {
                        swal("Error!", data, "error");
                        console.log(data);
                    }
                });
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.adminbsb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\PHP\laraton\laravel\resources\views/config/group.blade.php ENDPATH**/ ?>
