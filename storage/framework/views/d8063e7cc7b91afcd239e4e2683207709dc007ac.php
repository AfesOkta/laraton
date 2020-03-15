<?php $__env->startSection('title', 'SCRAPER'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left">
            <div class="card">
                <form id="scaper">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line success">
                                        <input type="text" id="email" name="email" class="form-control"
                                               value="<?php echo e($scraper->email); ?>" required="required">
                                        <label class="form-label" for="email">Email <span
                                                class="col-red">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line success">
                                        <input type="password" id="password" name="password" class="form-control"
                                               value="<?php echo e($scraper->password); ?>" required="required">
                                        <label class="form-label" for="password">Password <span
                                                class="col-red">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line success">
                                        <input type="text" id="subname" name="subname" class="form-control"
                                               value="<?php echo e($scraper->subname); ?>" required="required">
                                        <label class="form-label" for="subname">IMO, NAME, COMPANY <span
                                                class="col-red">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line success">
                                        <input type="text" id="mmsi" name="mmsi" class="form-control"
                                               value="<?php echo e($scraper->mmsi); ?>" required="required">
                                        <label class="form-label" for="mmsi">MMSI <span
                                                class="col-red">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line success">
                                        <input type="checkbox" value="SHIP" id="ship"
                                               class="chk-col-green filled-in checkbox-group" name="ship"/>
                                        <label for="ship">SHIP</label>
                                        <input type="checkbox" value="COMPANY" id="company"
                                               class="chk-col-green filled-in checkbox-group" name="company"/>
                                        <label for="company">Company</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect pull-right" onclick="scraper_work();">
                            SCRAPE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('template/adminbsb/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet"/>

    <!-- Bootstrap Material Datetime Picker Css -->
    <link
        href="<?php echo e(asset('template/adminbsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>"
        rel="stylesheet"/>

    <!-- Fontawesome Iconpicker -->
    <link href="<?php echo e(asset('ext/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        function scraper_work() {
            var email = $('#email').val();
            var password = $('#password').val();
            var subname = $('#subname').val();
            var mmsi = $('#mmsi').val();
            var ship = $('#ship').val();
            var company = $('#company').val();

            $.ajax({
                type: "GET",
                data: {email: email, password: password, subname:subname, mmsi:mmsi, ship:ship, company:company},
                url: "<?php echo e(url('/scraper/scrape')); ?>",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    // $('#social-id').val(sid);
                    // $('#social-name').val(data.name);
                    // $('#social-icon').val(data.icon);
                    // $('#display-icon').html('<span class="socicon-icon '+data.icon+'" style="background-color: '+data.color+'"></span>');
                    // $('#social-link').val(data.link);
                    // $('#social-input').modal('show');
                },
                error: function (data) {
                    showAlert('Error: ' + data, 'bg-red');
                }
            })
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.adminbsb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laraton\resources\views/scraper/scraper.blade.php ENDPATH**/ ?>