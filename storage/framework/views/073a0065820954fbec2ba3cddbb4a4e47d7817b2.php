<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light">AZUMINO</span>
    </a>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info w-100 ">
            <div class="card bg-secondary text-white m-0">
                <div class="card-header">
                    <h3 class="card-title m-0">情報検索</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar">
        <form id="form-goods-his">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="lot-no">ロットNo</label>
                <input type="text" name="lot_no" class="form-control" id="lot-no" autocomplete="off" placeholder="YYYYMMDD.XX">
            </div>
            <div class="form-group">
                <label for="actual-vote">現品票No</label>
                <input type="text" class="form-control" name="actual_vote" id="actual-vote" autocomplete="off" placeholder="Number">
            </div>
            <div class="form-group">
                <label id="label-work-date-from" for="create-date-from">出庫日From</label>
                <div class="input-group">
                    <input id="create-date-from" type="text" name="create_date_from" class="form-control input-time datepicker" value="<?php echo e($condition->create_date_from); ?>">
                </div>
            </div>
            <div class="form-group">
                <label id="label-work-date-to" for="create-date-to">出庫日to</label>
                <div class="input-group someOtherWidget">
                    <input id="create-date-to" name="create_date_to" class="form-control input-time datepicker" value="<?php echo e($condition->create_date_to); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="ship-grp-key">グループ</label>
                <select id="ship-grp-key" class="form-control select2-not-search" name="ship_grp_key">
                    <option selected="selected" value="">すべて</option>
                    <?php $__currentLoopData = $mShipGrp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($grp->ship_grp_key); ?>"><?php echo e($grp->ship_grp_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ship-des-name">出庫先</label>
                <select id="ship-des-name" class="form-control select2" name="ship_des_id">
                    <option selected="selected" value="">すべて</option>
                    <?php $__currentLoopData = $mShipDests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mShipDes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mShipDes->ship_des_id); ?>"><?php echo e($mShipDes->ship_des_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label id="worker-name">作業者</label>
                <select id="worker-name" name="worker_id" class="form-control select2-not-search">
                    <option selected="selected" value="">すべて</option>
                    <?php $__currentLoopData = $workers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $worker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($worker->worker_id); ?>"><?php echo e($worker->worker_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <button type="reset" class="btn btn-outline-secondary btn-block" onclick="resetForm()">クリア</button>
                </div>
                <div class="col-lg-6 mb-2">
                    <button type="button" class="btn btn-outline-secondary btn-block" onclick="jQuery.GoodsHis.func_search()">検索</button>
                </div>
            </div>

        </form>
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/goods-history/left.blade.php ENDPATH**/ ?>