<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/common.js')); ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('dist/jquery-ui-1.12.1/jquery-ui.min.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('dist/jquery-ui-1.12.1/jquery-ui.min.js')); ?>"></script>

    <script>
        $(function () {
            $('.datepicker').datepicker({dateFormat: 'yy/mm/dd'});
        });
    </script>
</head>

<body class="hold-transition layout-fixed">
<div class="wrapper">
    <?php echo $__env->yieldContent('head'); ?>
    <?php echo $__env->yieldContent('left'); ?>
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
    </footer>
</div>
<?php echo $__env->yieldContent('end-javascript'); ?>
<div class="modal fade" id="modal-change-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
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
                            <label for="current_password" class="col-sm-5 col-form-label">現在のパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="current_password"
                                       id="current_password" required>
                                <small id="current_password-validator" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_password" class="col-sm-5 col-form-label">新しいパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                       required>
                                <small id="new_password-validator" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_confirm_password" class="col-sm-5 col-form-label">確認のパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="new_confirm_password"
                                       id="new_confirm_password" required>
                                <small id="new_confirm_password-validator" class="form-text text-danger"></small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer d-block">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-block" onclick="changePassword()">変更</button>
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
<?php /**PATH /home/vagrant/code/azumino-final/resources/views/layouts/master.blade.php ENDPATH**/ ?>