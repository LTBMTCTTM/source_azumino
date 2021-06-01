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
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">ロットNo</label>
                <input type="text" class="form-control" id="exampleInputEmail1" autocomplete="off" placeholder="YYYYMMDD.XX">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">現品票No</label>
                <input type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Number">
            </div>
            <div class="form-group">
                <label>出庫日From</label>
                <div class="input-group">
                    <input id="datepicker" class="form-control input-time datepicker" value="<?php echo e(date('Y/m/01')); ?>">
                </div>
            </div>
            <div class="form-group">
                <label>出庫日to</label>
                <div class="input-group">
                    <input id="datepicker" class="form-control input-time datepicker" value="<?php echo e(date('Y/m/t')); ?>">
                </div>
            </div>
            <div class="form-group">
                <label>出庫先</label>
                <select class="form-control select2">
                    <option selected="selected">すべて</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                </select>
            </div>
            <div class="form-group">
                <label>作業者</label>
                <select class="form-control select2">
                    <option selected="selected">すべて</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                </select>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <button type="submit" class="btn btn-outline-secondary btn-block">クリア</button>
                </div>
                <div class="col-lg-6 mb-2">
                    <button type="submit" class="btn btn-outline-secondary btn-block">検索</button>
                </div>
            </div>

        </form>
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /home/vagrant/code/azumino-final/resources/views/goods-history/left.blade.php ENDPATH**/ ?>