<?php

namespace App\Http\Controllers;

use App\Models\MWorker;
use App\Models\MWorkerSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $validator = Validator::make($request->all(), [
                'isNew' => 'required',
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }
            $isNew = $request->post('id', 1);
            /*show modal add new item*/
            if ($isNew == 1){
                return response()->json([
                    'status' => true,
                    'form' => view('workers.modal-detail-form', ['model' => new MWorker()])->render()
                ], 200);
            }

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

    public function delete(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'worker_id' => 'required'
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }

            $model = MWorker::query()->find($request->worker_id);
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
                'worker_id' => 'required|max:10',
                'worker_name' => 'required|max:50',
                'store_name' => 'required|max:120',
                'disabled_flag' => 'required',
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }
            $model = MWorker::query()->find($request->worker_id);
            if (!$model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item not found';
                return response()->json($res);
            }
            $model->worker_name = $request->worker_name;
            $model->store_name = $request->store_name;
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
                'worker_id' => 'required|max:10',
                'worker_name' => 'required|max:50',
                'store_name' => 'required|max:120',
                'disabled_flag' => 'required',
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }
            $model = MWorker::query()->find($request->worker_id);
            if ($model) {
                $res = ['status' => false];
                $res['message']['id'] = 'The item does exist';
                return response()->json($res);
            }
            $model = new MWorker();

            $model->worker_id = $request->worker_id;
            $model->worker_name = $request->worker_name;
            $model->store_name = $request->store_name;
            $model->disabled_flag = $request->disabled_flag;

            $model->save();

            return response()->json(['status' => true,], 200);

        } catch (\Throwable $e) {
            throw $e;
        }
    }

}
