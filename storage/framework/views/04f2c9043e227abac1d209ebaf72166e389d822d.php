<div class="col-md-12">
    <form id="form-worker-detail" method="POST"
          enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group row">
            <label for="modal-worker-id" class="col-md-2 col-sm-2 col-form-label">コード</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" class="form-control" value="<?php echo e($model->worker_id); ?>"
                       <?php echo e($model->worker_id?'disabled':''); ?> minlength="3" maxlength="10" onkeyup="$('#modal-worker-id-hide').val(this.value)"
                       id="modal-worker-id" required>
                <small id="modal-worker-id-validator" class="form-text text-danger"></small>
                <input type="text" class="form-control d-none" id="modal-worker-id-hide" name="worker_id" value="<?php echo e($model->worker_id); ?>"
                       required>
            </div>
            <label for="modal-worker-name" class="col-md-2 col-sm-3 col-form-label">作業員名</label>
            <div class="col-md-5 col-sm-4">
                <input type="text" class="form-control" name="worker_name"
                       id="modal-worker-name" value="<?php echo e($model->worker_name); ?>">
                <small id="modal-worker-name-validator" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="modal-store-name" class="col-sm-2 col-form-label">所属倉庫・工場</label>
            <div class="col-sm-10">
                <input id="modal-store-name" type="text" class="form-control" name="store_name"
                       value="<?php echo e($model->store_name); ?>">
                <small id="modal-store-name-validator" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="modal-ship-grp-key" class="col-sm-2 col-form-label">状態</label>
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
<?php /**PATH /home/vagrant/Code/azumino/resources/views/workers/modal-detail-form.blade.php ENDPATH**/ ?>