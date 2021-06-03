<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo e(asset('js/app.js?v='.strtotime(date(TIME_FORMAT)))); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/common.js?v='.strtotime(date(TIME_FORMAT)))); ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dist/jquery-ui-1.12.1/jquery-ui.min.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('dist/jquery-ui-1.12.1/jquery-ui.min.js')); ?>"></script>

    <script src="<?php echo e(asset('dist/select2/dist/js/select2.min.js')); ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dist/select2/dist/css/select2.min.css')); ?>">

    <script>
        $( function() {
            $( ".datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});
        } );
    </script>
    <script>
        $(function () {
            //$('#work-date-from').datepicker({dateFormat: 'yy/mm/dd',currentText: "Now"});
            $('.select2').select2({});
            $('.select2-not-search').select2({ minimumResultsForSearch: -1});
            $('.select2-full-width').select2({ width: '100%'});
        });
    </script>
</head>

<body class="hold-transition">
<?php echo $__env->make("components.progress_bar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="wrapper">
    <?php echo $__env->yieldContent('head'); ?>
    <?php echo $__env->yieldContent('left'); ?>
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Azumino Mineral Water Co., Ltd. 2021
        </div>
    </footer>
</div>
<?php echo $__env->yieldContent('end-javascript'); ?>
<div class="modal fade" id="modal-change-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header az-bg-primary">
                <div class="col-1"></div>
                <div class="col-10 text-center">
                    <span class="modal-title font-weight-bold text-white">パスワード変更</span>
                </div>
                <div class="col-1 ms-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="form-change-password" method="POST" action="<?php echo e(route('change.password')); ?>"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="current-password" class="col-sm-5 col-form-label">現在のパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="current_password"
                                       id="current-password" required>
                                <small id="current_password-validator" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new-password" class="col-sm-5 col-form-label">新しいパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="new_password" id="new-password"
                                       required>
                                <small id="new_password-validator" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_confirm_password" class="col-sm-5 col-form-label">確認のパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="new_confirm_password"
                                       id="new_confirm_password" required>
                            </div>
                        </div>
                        <div class="form-group text-center m-0">
                            <p class="text-red text-bold m-0" id="change-password-validator">&nbsp;</p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer d-block">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-primary az-bg-primary btn-block" onclick="changePassword()">変更</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</body>

</html>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/layouts/master.blade.php ENDPATH**/ ?>