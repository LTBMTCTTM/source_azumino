<div class="modal fade" id="modal-shipping-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header az-bg-primary">
                <div class="col-1"></div>
                <div class="col-10 text-center">
                    <span class="modal-title font-weight-bold text-white">出庫先編集</span>
                </div>
                <div class="col-1 ms-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer d-block">
                    <div class="row modal-footer-insert">
                        <div class="col-md-6 d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">閉じる</button>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-primary az-bg-primary btn-block" onclick="jQuery.Shipping.func_modal_add_new_confirm()">保存</button>
                        </div>
                    </div>
                    <div class="row modal-footer-update">
                        <div class="col-md-4 d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-danger btn-block" onclick="jQuery.Shipping.func_modal_delete_confirm()">削除</button>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">閉じる</button>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-primary az-bg-primary btn-block" onclick="jQuery.Shipping.func_modal_update_confirm()">保存</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/shipping-destinations/modal-detail.blade.php ENDPATH**/ ?>