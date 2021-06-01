
<nav class="main-header navbar navbar-expand navbar-white navbar-light head">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block" style="width: 170px">
            <a href="<?php echo e(route('goods.history')); ?>">
                <button type="button" class="btn btn-block btn-outline-secondary az-bg-light text-bold" <?php echo e(request()->is('goods-history') ? 'disabled' : ''); ?>>出庫履歴</button>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block ml-2" style="width: 170px">
            <select class="form-control border-secondary az-bg-light text-bold" onchange="location = this.value;">
                <option <?php echo e(request()->is('shipping-destinations') || request()->is('workers')? '' : 'selected'); ?>></option>
                <option value="<?php echo e(route('shipping.destinations')); ?>" <?php echo e(request()->is('shipping-destinations') ? 'selected' : ''); ?>>出庫先マスタ</option>
                <option value="<?php echo e(route('workers')); ?>" <?php echo e(request()->is('workers') ? 'selected' : ''); ?>>作業員マスタ</option>
            </select>
        </li>
        <li class="nav-item">
            <button type="button" class="btn text-primary" data-toggle="modal" data-target="#modal-change-password">
                パスワード変更
            </button>
        </li>
        <li class="nav-item">
            <a href="/logout" class="nav-link text-primary">ログアウト</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/layouts/head.blade.php ENDPATH**/ ?>