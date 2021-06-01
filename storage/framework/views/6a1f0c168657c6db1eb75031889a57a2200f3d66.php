<?php $__env->startSection('title',APP_NAME. ' | 出庫先一覧'); ?>
<?php $__env->startSection('head'); ?>
    <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left'); ?>
    <?php echo $__env->make('shipping-destinations.left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <h4 class="font-weight-bold text-center">出庫先一覧</h4>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" class="btn az-bg-primary" onclick="jQuery.Shipping.func_detail('', true)">
                            新規登録
                        </button>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="table-shipping-destinations" class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">コード</th>
                            <th class="text-center">出庫先名</th>
                            <th class="text-center">住所</th>
                            <th class="text-center">電話番号</th>
                            <th class="text-center">無効状態</th>
                            <th class="text-center">詳細</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="<?php echo e($row->ship_des_id); ?>">
                                <td class="text-center"><?php echo e($row->ship_des_id); ?></td>
                                <td class="text-left"><?php echo e($row->ship_des_name); ?></td>
                                <td class="text-left"> <?php echo e($row->ship_des_addr); ?> </td>
                                <td class="text-center"> <?php echo e($row->ship_des_tel); ?> </td>
                                <?php if($row->disabled_flag ==0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center text-red">無効</td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <button class="btn az-bg-primary" id="<?php echo e($row->ship_des_id); ?>"
                                            onclick="jQuery.Shipping.func_detail(this)">詳細
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" id="paginator">
                    <?php echo paginator($currentPage , PAGE_LIMITS, $total, "jQuery.Shipping.func_paging(this)"); ?>

                </div>
            </div>
        </div>
    </section>
    <?php echo $__env->make('shipping-destinations.modal-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('end-javascript'); ?>
    <script type="text/javascript"
            src="<?php echo e(asset('js/shipping-destinations.js?v='.strtotime(date(TIME_FORMAT)))); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/azumino/resources/views/shipping-destinations/index.blade.php ENDPATH**/ ?>