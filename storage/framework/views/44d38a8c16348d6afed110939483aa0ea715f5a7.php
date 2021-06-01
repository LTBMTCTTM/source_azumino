
<?php $__env->startSection('title','Home'); ?>
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
                <div class="col-sm-6">
                    <h4 class="font-weight-bold">出庫履歴</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" class="btn btn-primary">ダウンロード</button>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
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
                        <?php $__currentLoopData = range(0, 19); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center">2021/07/01</td>
                                <td class="text-center">2021/07/02</td>
                                <td class="text-center">20210620.BE</td>
                                <td class="text-center">160</td>
                                <td class="text-center">10/10</td>
                                <td class="text-left">ファミリーマート横浜大黒常温センター</td>
                                <td class="text-center">4893</td>
                                <td class="text-center">16:40</td>
                                <td class="text-left">中山</td>
                                <td class="text-left">出庫元</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('end-javascript'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/goods-history.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/azumino-final/resources/views/goods-history/index.blade.php ENDPATH**/ ?>