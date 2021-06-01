<?php

namespace App\Http\Controllers;

use App\Models\MShipDest;
use App\Models\MShipGroup;
use App\Models\MShipDestSearch;
use Illuminate\Http\Request;

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
        $model = $mShipDes->search($condition, 1);
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
            $id = $request->post('id', -1);

            $model = MShipDest::query()->find($id);
            $mShipGrp = MShipGroup::query()
                ->get();

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
            print_r($request->all());exit;
            $model = MShipDest::query()->find($request->ship_des_id);

            if (!$model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item not found';
                return response()->json($res);
            }
            //$model->delete();
            return response()->json(['status' => true,], 200);

        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
