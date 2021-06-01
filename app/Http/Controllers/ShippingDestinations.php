<?php

namespace App\Http\Controllers;

use App\Models\MShipDest;
use App\Models\MShipGroup;
use App\Models\MShipDestSearch;
use App\Rules\WorkerExist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingDestinations extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function index()
    {
        $mShipGrp = MShipGroup::query()
            ->get();


        $mShipDes = new MShipDest();
        $condition = new MShipDestSearch();
        try {
            $model = $mShipDes->search($condition, 1);
        } catch (\Throwable $e) {
        }
        if (empty($model)):
            $currentPage = 1;
            $total = 0;
        else:
            $currentPage = $model->currentPage();
            $total = $model->total();
        endif;
        return view('shipping-destinations.index', [
            'mShipGrp' => $mShipGrp,
            'model' => $model,

            'currentPage' => $currentPage,
            'total' => $total,
        ]);
    }

    public function search(Request $request)
    {
        try {
            $page = $request->get('page', 1);

            $limit = PAGE_LIMITS;

            $condition = new MShipDestSearch();
            //print_r($request->all());exit;
            if (!$condition->isValidate($request->all())) {
                $res = ['status' => false];
                $res['message'] = $condition->getErrors();
                return response()->json($res);
            }


            $mShipDes = new MShipDest();
            $model = $mShipDes->search($condition, $page);

            return response()->json(
                [
                    'status' => true,
                    "model" => $model,
                    'paginator' => paginator($page, $limit, $model->total(), "jQuery.Shipping.func_paging(this)")
                ], 200);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function detail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'isNew' => 'required',
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }

            $mShipGrp = MShipGroup::query()
                ->get();
            $isNew = $request->post('id', 1);
            /*show modal add new item*/
            if ($isNew == 1){
                return response()->json([
                    'status' => true,
                    'form' => view('shipping-destinations.modal-detail-form', ["mShipGrp" => $mShipGrp, "model" => new MShipDest()])->render()
                ], 200);
            }
            $id = $request->post('id', -1);
            $model = MShipDest::query()->find($id);

            if (!$model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item not found';
                return response()->json($res);
            }
            return response()->json([
                'status' => true,
                'form' => view('shipping-destinations.modal-detail-form', ["mShipGrp" => $mShipGrp, "model" => $model])->render()
            ], 200);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function delete(Request $request)
    {
        try {

            $model = MShipDest::query()->find($request->ship_des_id);

            if (!$model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item not found';
                return response()->json($res);
            }
            $model->delete();
            return response()->json(['status' => true,], 200);

        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'ship_des_id' => 'required',/*
                'ship_des_tel' => 'required',
                'ship_des_name' => 'required',
                'ship_des_addr' => 'required',
                'ship_grp_key' => 'required',
                'disabled_flag' => 'required',*/
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }
            $model = MShipDest::query()->find($request->ship_des_id);
            if (!$model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item not found';
                return response()->json($res);
            }
            $model->ship_des_tel = $request->ship_des_tel;
            $model->ship_des_tel_num = str_replace('-', '', $request->ship_des_tel);
            $model->ship_des_name = $request->ship_des_name;
            $model->ship_des_addr = $request->ship_des_addr;
            $model->disabled_flag = $request->disabled_flag;

            $model->save();


            //$model->delete();
            return response()->json(['status' => true,], 200);

        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function addNew(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'ship_des_id' => 'required',
                'ship_des_tel' => 'required',
                'ship_des_name' => 'required',
                'ship_des_addr' => 'required',
                'ship_grp_key' => 'required',
                'disabled_flag' => 'required',
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }
            $model = MShipDest::query()->find($request->ship_des_id);
            if ($model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item does exist';
                return response()->json($res);
            }
            $model = new MShipDest();

            $model->ship_des_id = $request->ship_des_id;
            $model->ship_des_tel = $request->ship_des_tel;
            $model->ship_des_tel_num = str_replace('-', '', $request->ship_des_tel);
            $model->ship_des_name = $request->ship_des_name;
            $model->ship_des_addr = $request->ship_des_addr;
            $model->disabled_flag = $request->disabled_flag;

            $model->save();

            return response()->json(['status' => true,], 200);

        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
