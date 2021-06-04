<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\MConfig;
use App\Models\MShipDest;
use App\Models\MWorker;
use App\Models\TShipHis;
use App\Models\TShipHisDetail;
use App\Rules\WorkerExist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        return $request;
    }

    public function getWorkers(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                $res = ['result' => 'NG'];
                $res['message'] = $validator->errors();
                return response()->json($res);
            }

            if (!$this->validateUser($request->user_id, $request->password)) {
                $res = ['result' => 'NG'];
                $res['message'] = 'The user id or password is wrong.';
                return response()->json($res);
            };

            $curDate = date(TIME_FORMAT);
            $res['last_request'] = $curDate;
            $lastDate = $request->get('last_updated', $curDate);

            DB::beginTransaction();
            $check = MWorker::query();
            if ($lastDate != '') {
                $check->whereBetween('last_update', [$lastDate, $curDate]);
                $check->orWhereBetween('create_date', [$lastDate, $curDate]);
            }

            $count = $check->count();
            if ($count > 0) {
                $workers = MWorker::query()->where('disabled_flag', 0);
                $res['count'] = $workers->count();
                $res['worker_list'] = $workers->get();
                DB::commit();
                return response()->json($res);
            }
            $res['count'] = 0;
            $res['worker_list'] = [];
            DB::commit();
            return response()->json($res);

        } catch (\Throwable $e) {
            DB::rollBack();
            $res = ['result' => 'NG'];
            $res['message'] = 'Has errors please try again';
            return response()->json($res);
            throw $e;
        }
    }

    public function getShipdes(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                $res = ['result' => 'NG'];
                $res['message'] = $validator->errors();
                return response()->json($res);
            }

            if (!$this->validateUser($request->user_id, $request->password)) {
                $res = ['result' => 'NG'];
                $res['message'] = 'The user id or password is wrong.';
                return response()->json($res);
            };

            $curDate = date(TIME_FORMAT);
            $res['last_request'] = $curDate;

            $lastDate = $request->get('last_updated', $curDate);

            DB::beginTransaction();
            $check = MShipDest::query();
            if ($lastDate != '') {
                $check->whereBetween('last_update', [$lastDate, $curDate]);
                $check->orWhereBetween('create_date', [$lastDate, $curDate]);
            }

            $count = $check->count();
            if ($count > 0) {
                $mShipDes = MShipDest::query()
                    ->where('disabled_flag', 0);
                $res['count'] = $mShipDes->count();
                $res['shipdes_list'] = $mShipDes->get();
                DB::commit();
                return response()->json($res);
            }
            $res['count'] = 0;
            $res['shipdes_list'] = [];
            DB::commit();
            return response()->json($res);
        } catch (\Throwable $e) {
            DB::rollBack();
            $res = ['result' => 'NG'];
            $res['message'] = 'Has errors please try again';
            return response()->json($res);
            throw $e;
        }
    }

    public function sendData(Request $request)
    {
        try {
            $res = ['result' => 'NG'];
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'password' => 'required',
                'ship_des_id' => 'required',
                'palette_plan' => 'required',
                'palette_result' => 'required',
                'worker_id' => [
                    'required',
                    new WorkerExist()
                ],
            ]);
            if ($validator->fails()) {
                $res['message'] = $validator->errors();
                return response()->json($res);
            }
            if (!$this->validateUser($request->user_id, $request->password)) {
                $res = ['result' => 'NG'];
                $res['message'] = 'The user id or password is wrong.';
                return response()->json($res);
            };


            $validator_detail = Validator::make($request->only('detail'), [
                'detail' => 'present|array',
                'detail.*.index' => 'required|integer',
                'detail.*.lot_no' => 'required',
                'detail.*.actual_vote' => 'required|integer',
            ]);

            if ($validator_detail->fails()) {
                $res['message'] = $validator_detail->errors();
                return response()->json($res);
            }

            DB::beginTransaction();

            $tShipHis = TShipHis::query()->create([
                'ship_date' => $request->ship_date,
                'car_num' => $request->car_num,
                'ship_des_id' => $request->ship_des_id,
                'palette_plan' => $request->palette_plan,
                'palette_result' => $request->palette_result,
                'worker_id' => $request->worker_id
            ]);

            $detail_id = $tShipHis->id;
            foreach ($request->detail as $detail) {
                TShipHisDetail::query()->create([
                    'id' => $detail_id,
                    'index' => $detail['index'],
                    'lot_no' => $detail['lot_no'],
                    'actual_vote' => $detail['actual_vote']
                ]);
            }
            DB::commit();
            $res['result'] = 'OK';
            return response()->json($res);
        } catch (\Throwable $e) {
            DB::rollback();
            $res = ['result' => 'NG'];
            $res['message'] = 'Has errors please try again';
            return response()->json($res);
            throw $e;
        }
    }

    private function validateUser($user_id, $password)
    {

        if ($user_id !== API_USER_ID || $password !== API_PASSWORD) {
            return false;
        };

        return true;
    }
}
