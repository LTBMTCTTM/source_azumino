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
        <form id="form-workers">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="workers-id">作業員コード</label>
                <input type="text" class="form-control" name="worker_id" id="workers-id" autocomplete="off" placeholder="">
            </div>
            <div class="form-group">
                <label for="workers-name">作業員名</label>
                <input type="text" class="form-control" name="worker_name" id="workers-name" autocomplete="off" placeholder="">
            </div>
            <div class="form-group">
                <label for="store-name">所属名称</label>
                <input type="text" class="form-control" name="store_name" id="store-name" autocomplete="off" placeholder="">
            </div>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <button type="reset" class="btn btn-outline-secondary btn-block" onclick="resetForm()">クリア</button>
                </div>
                <div class="col-lg-6 mb-2">
                    <button type="button" class="btn btn-outline-secondary btn-block" onclick="jQuery.Workers.func_search()">検索</button>
                </div>
            </div>

        </form>
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /home/vagrant/Code/azumino/resources/views/workers/left.blade.php ENDPATH**/ ?>