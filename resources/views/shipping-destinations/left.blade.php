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
        <form id="form-shipping-destinations">
            @csrf
            <div class="form-group">
                <label for="ship-grp-key">グループ</label>
                <select id="ship-grp-key" class="form-control select2-not-search" name="ship_grp_key">
                    <option selected="selected" value="">すべて</option>
                    @foreach($mShipGrp as $grp)
                        <option value="{{$grp->ship_grp_key}}">{{$grp->ship_grp_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ship-des-id">出庫先コード</label>
                <input type="text" class="form-control" name="ship_des_id" id="ship-des-id" autocomplete="off" placeholder="">
            </div>
            <div class="form-group">
                <label for="ship-des-name">出庫先名</label>
                <input type="text" class="form-control" name="ship_des_name" id="ship-des-name" autocomplete="off" placeholder="">
            </div>
            <div class="form-group">
                <label for="ship-des-tel">電話番号</label>
                <input type="text" class="form-control" name="ship_des_tel" id="ship-des-tel" autocomplete="off" placeholder="">
            </div>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <button type="reset" class="btn btn-outline-secondary btn-block" onclick="resetForm()">クリア</button>
                </div>
                <div class="col-lg-6 mb-2">
                    <button type="button" class="btn btn-outline-secondary btn-block" onclick="jQuery.Shipping.func_search()">検索</button>
                </div>
            </div>

        </form>
    </div>
    <!-- /.sidebar -->
</aside>
