<?php

namespace App\Http\Controllers;

use App\Models\MWorker;
use App\Models\MWorkerSearch;
use Illuminate\Http\Request;

class WorkersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function index()
    {
        $mWorker = new MWorker();
        $condition = new MWorkerSearch();
        $model = $mWorker->search($condition, 1);

        if (empty($model)):
            $currentPage = 1;
            $total = 0;
        else:
            $currentPage = $model->currentPage();
            $total = $model->total();
        endif;
        return view('workers.index', [
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

            $condition = new MWorkerSearch();
            //print_r($request->all());exit;
            if (!$condition->isValidate($request->all())) {
                $res = ['status' => false];
                $res['message'] = $condition->getErrors();
                return response()->json($res);
            }


            $mWorker = new MWorker();
            $model = $mWorker->search($condition, $page);

            return response()->json(
                [
                    'status' => true,
                    "model" => $model,
                    'paginator' => paginator($page, $limit, $model->total(), "jQuery.Workers.func_paging(this)")
                ], 200);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function detail(Request $request)
    {
        try {
            $id = $request->post('id', 0);

            $model = MWorker::query()->find($id);
            if (!$model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item not found';
                return response()->json($res);
            }
            return response()->json([
                'status' => true,
                'form' => view('workers.modal-detail-form', ['model' => $model])->render()
            ], 200);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
