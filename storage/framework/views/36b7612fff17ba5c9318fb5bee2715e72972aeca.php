<?php $__env->startSection('title',APP_NAME. ' | 出庫履歴'); ?>
<?php $__env->startSection('head'); ?>
    <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left'); ?>
    <?php echo $__env->make('goods-history.left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-danger" onclick="jQuery.GoodsHis.func_delete_confirm()">削除</button>
                </div>
                <div class="col-sm-4">
                    <h4 class="font-weight-bold text-center">出庫履歴</h4>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" class="btn az-bg-primary" onclick="jQuery.GoodsHis.func_export()">ダウンロード</button>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="goods-history-table" class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" onchange="checkAll(this)"/>
                                    <span class="custom-control-label"></span>
                                </label>
                            </th>
                            <th class="text-center">出庫日</th>
                            <th class="text-center">納品日</th>
                            <th class="text-center">ロットNo</th>
                            <th class="text-center">現品票No</th>
                            <th class="text-center">PL枚数</th>
                            <th class="text-center">出庫先</th>
                            <th class="text-center">車番</th>
                            <th class="text-center">出庫時刻</th>
                            <th class="text-center">作業者名</th>
                            <th class="text-center">出庫元</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="<?php echo e($row->id.'-'.$row->index); ?>">
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="<?php echo e($row->id.'-'.$row->index); ?>" onchange="isCheckAll(this)"/>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center"><?php echo e($row->create_date == null ? '' : date(DATE_FORMAT,  strtotime($row->create_date))); ?></td>
                                <td class="text-center"><?php echo e($row->ship_date == null ? '' : date(DATE_FORMAT, strtotime($row->ship_date))); ?></td>
                                <td class="text-center"> <?php echo e($row->lot_no); ?> </td>
                                <td class="text-center"> <?php echo e($row->actual_vote); ?> </td>
                                <td class="text-center"> <?php echo e($row->index.'/'.$row->palette_plan); ?> </td>
                                <td class="text-left"> <?php echo e($row->ship_des_name); ?> </td>
                                <td class="text-center"><?php echo e($row->car_num); ?></td>
                                <td class="text-center"><?php echo e($row->create_date == null ? '' : date('HH:i', strtotime($row->create_date))); ?></td>
                                <td class="text-left"> <?php echo e($row->worker_name); ?> </td>
                                <td class="text-left"> <?php echo e($row->store_name); ?> </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" id="paginator">
                    <?php echo paginator($currentPage , PAGE_LIMITS, $total, "jQuery.GoodsHis.func_paging(this)"); ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('end-javascript'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/goods-history.js?v='.strtotime(date(TIME_FORMAT)))); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/azumino/resources/views/goods-history/index.blade.php ENDPATH**/ ?>