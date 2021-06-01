<div class="col-md-12">
    <form id="form-worker-detail" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="modal-worker-id" class="col-md-2 col-sm-2 col-form-label">コード</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" class="form-control" value="{{$model->worker_id}}" disabled
                       id="modal-worker-id" required>
                <small id="modal-worker-id-validator" class="form-text text-danger"></small>
                <input type="text" class="form-control d-none" name="ship_des_id" value="{{$model->worker_name}}"
                       required>
            </div>
            <label for="modal-worker-name" class="col-md-2 col-sm-3 col-form-label">作業員名</label>
            <div class="col-md-5 col-sm-4">
                <input type="text" class="form-control" name="worker_name"
                       id="modal-worker-name" value="{{$model->worker_name}}">
                <small id="modal-worker-name-validator" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="modal-store-name" class="col-sm-2 col-form-label">所属倉庫・工場</label>
            <div class="col-sm-10">
                <input id="modal-store-name" type="text" class="form-control" name="store_name"
                       value="{{$model->store_name}}">
                <small id="modal-store-name-validator" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="modal-ship-grp-key" class="col-sm-2 col-form-label">状態</label>
            <div class="col-sm-2">
                <div class="col-form-label">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="disabled-flag" name="disabled_flag"
                               value="0" {{ $model->disabled_flag === 0 ? 'checked' : '' }}>
                        <label for="disabled-flag" class="custom-control-label">有効</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="col-form-label">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="disabled-flag-non" name="disabled_flag"
                               value="1" {{ $model->disabled_flag === 1 ? 'checked' : '' }}>
                        <label for="disabled-flag-non" class="custom-control-label">無効</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
