<?php

namespace App\Http\Controllers;

use App\Models\MShipDest;
use App\Models\MShipGroup;
use App\Models\MWorker;
use App\Models\TShipHis;
use App\Models\TShipHisDetail;
use App\Models\TShipHisSearch;
use Illuminate\Http\Request;

class GoodsHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function index()
    {
        $mShipDests = MShipDest::query()
            ->where('disabled_flag', 0)
            ->get();

        $workers = MWorker::query()
            ->where('disabled_flag', 0)
            ->get();

        $mShipGrp = MShipGroup::query()
            ->get();

        $condition = new TShipHisSearch();

        $tShipHis = new TShipHis();
        try {
            $model = $tShipHis->search($condition, 1);
        } catch (\Throwable $e) {
        }

        if (empty($model)):
            $currentPage = 1;
            $total = 0;
        else:
            $currentPage = $model->currentPage();
            $total = $model->total();
        endif;

        return view('goods-history.index', [
            'mShipDests' => $mShipDests,
            'workers' => $workers,
            'mShipGrp' => $mShipGrp,
            'condition' => $condition,
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

            $condition = new TShipHisSearch();
            if (!$condition->isValidate($request->all())) {
                $res = ['status' => false];
                $res['message'] = $condition->getErrors();
                return response()->json($res);
            }


            $tShipHis = new TShipHis();
            $model = $tShipHis->search($condition, $page);

            return response()->json(
                [
                    'status' => true,
                    "model" => $model,
                    'paginator' => paginator($page, $limit, $model->total(), "jQuery.GoodsHis.func_paging(this)")
                ], 200);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->post('ids', []);

            if (count($ids) === 0) {
                $res = ['status' => false];
                $res['message']['id'] = "id not null";
                return response()->json($res);
            }

            foreach ($ids as $key => $row) {
                $id = explode('-', $row);
                TShipHisDetail::query()
                    ->where('id', '=', $id[0])
                    ->where('index', '=', $id[1])
                    ->update(['delete_flag' => 1]);
            }

            return response()->json(['status' => true], 200);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function export(Request $request)
    {
        try {
            $condition = new TShipHisSearch();
            if (!$condition->isValidate($request->all())) {
                $res = ['status' => false];
                $res['message'] = $condition->getErrors();
                return response()->json($res);
            }


            $tShipHis = new TShipHis();
            $file_path = $tShipHis->export($condition);

            return response()->json(
                [
                    'status' => true,
                    'message' => '',
                    'file_name' => '出庫履歴.' . date(TIME_FORMAT_CSV) . ".csv",
                    "file_path" => $file_path,
                ], 200
            );
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
