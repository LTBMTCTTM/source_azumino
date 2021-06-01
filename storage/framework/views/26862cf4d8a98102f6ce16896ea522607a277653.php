<script>
    $(function () {
        $('.select2-full-width').select2({width: '100%', minimumResultsForSearch: -1});
    });
</script>
<div class="col-md-12">
    <form id="form-shipping-detail" method="POST"
          enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group row">
            <label for="modal-ship-des-id" class="col-md-2 col-sm-2 col-form-label">コード</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" class="form-control" value="<?php echo e($model->ship_des_id); ?>" <?php echo e($model->ship_des_id ? 'disabled' : ''); ?>

                       id="modal-ship-des-id" minlength="3" maxlength="10" onkeyup="$('#modal-ship-des-id-hide').val(this.value)" required>
                <small id="modal-ship-des-id-validator" class="form-text text-danger"></small>
                <input type="text" class="form-control d-none" id="modal-ship-des-id-hide" name="ship_des_id" value="<?php echo e($model->ship_des_id); ?>"
                       required>
            </div>
            <label for="modal-ship-des-tel" class="col-md-2 col-sm-3 col-form-label">電話番号</label>
            <div class="col-md-5 col-sm-4">
                <input type="text" class="form-control" name="ship_des_tel"
                       id="modal-ship-des-tel" value="<?php echo e($model->ship_des_tel); ?>" maxlength="50">
                <small id="modal-ship-des-tel-validator" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="modal-ship-des-name" class="col-sm-2 col-form-label">出庫先名</label>
            <div class="col-sm-10">
                <input id="modal-ship-des-name" type="text" class="form-control" name="ship_des_name"
                       value="<?php echo e($model->ship_des_name); ?>" maxlength="40">
                <small id="modal-ship-des-name-validator" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="modal-ship-des-addr" class="col-sm-2 col-form-label">住所</label>
            <div class="col-sm-10">
                <input id="modal-ship-des-addr" type="text" class="form-control" name="ship_des_addr"
                       value="<?php echo e($model->ship_des_addr); ?>">
                <small id="modal-ship-des-addr-validator" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="modal-ship-grp-key" class="col-sm-2 col-form-label">グループ</label>
            <div class="col-sm-4">
                <select id="modal-ship-grp-key" name="ship_grp_key" class="form-control w-100 select2-full-width">
                    <?php $__currentLoopData = $mShipGrp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($grp->ship_grp_key); ?>" <?php echo e(substr($model->ship_des_id, 0, 2)===$grp->ship_grp_key ? 'selected' : ''); ?>><?php echo e($grp->ship_grp_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <label class="col-sm-2 col-form-label text-center">状態</label>
            <div class="col-sm-2">
                <div class="col-form-label">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="disabled-flag" name="disabled_flag"
                               value="0" <?php echo e($model->disabled_flag === 0 || !$model->disabled_flag ? 'checked' : ''); ?>>
                        <label for="disabled-flag" class="custom-control-label">有効</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="col-form-label">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="disabled-flag-non" name="disabled_flag"
                               value="1" <?php echo e($model->disabled_flag === 1 ? 'checked' : ''); ?>>
                        <label for="disabled-flag-non" class="custom-control-label">無効</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/shipping-destinations/modal-detail-form.blade.php ENDPATH**/ ?>