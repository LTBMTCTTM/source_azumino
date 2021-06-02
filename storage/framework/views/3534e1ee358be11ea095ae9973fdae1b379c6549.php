<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?= APP_NAME?> |  Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>

</head>
<body class="hold-transition">

<div class="bg-white login-page container">
    <div class="login-box">
        <div class="login-logo text-nowrap">
            <img src="<?php echo e(asset('/images/logo.png')); ?>" alt="The Logo" class="brand-image"
                 style="opacity: .8">
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control"
                               name="admin_id" placeholder="ログインID"
                               id="username"
                               value="<?php echo e(old('admin_id')); ?>" autofocus>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" placeholder="パスワード"
                               class="form-control" name="password"
                               autocomplete="current-password"/>

                    </div>
                    <div class="row">
                        <?php if(!$errors->has('password')): ?>
                        <p class="login-box-msg">ユーザ名とパスワードを入力してください。</p>
                        <?php endif; ?>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="login-box-msg text-red"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="text-center mb-3">
                        <button class="btn btn-block btn-primary">ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/auth/login.blade.php ENDPATH**/ ?>