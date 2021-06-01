<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TShipHis extends Model
{
    use HasFactory;
    protected $table = 't_ship_his';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ship_date',
        'car_num',
        'ship_des_id',
        'palette_plan',
        'palette_result',
        'worker_id',
    ];

    public function detail()
    {
        return $this->hasMany(TShipHisDetail::class, 'id');
    }

    public function search(TShipHisSearch $condition = null, $page = 1)
    {
        try {
            $limit = PAGE_LIMITS;
            $offset = $page != 0 ? ($page * $limit) - $limit : 0;

            $results = TShipHis::query()
                ->join('t_ship_his_detail', function ($join) {
                    $join->on('t_ship_his_detail.id', '=', 't_ship_his.id')
                        ->where('t_ship_his_detail.delete_flag', '=', 0);
                })
                ->leftJoin('m_worker', function ($join) {
                    $join->on('m_worker.worker_id', '=', 't_ship_his.worker_id')
                        ->where('m_worker.disabled_flag', '=', 0);
                })
                ->leftJoin('m_ship_des', function ($join) {
                    $join->on('m_ship_des.ship_des_id', '=', 't_ship_his.ship_des_id')
                        ->where('m_ship_des.disabled_flag', '=', 0);
                })
                ->select([
                    't_ship_his.id',
                    't_ship_his.work_date',
                    't_ship_his_detail.create_date',
                    't_ship_his.ship_date',
                    't_ship_his_detail.lot_no',
                    't_ship_his_detail.actual_vote',
                    't_ship_his_detail.index',
                    't_ship_his.palette_plan',
                    'm_ship_des.ship_des_name',
                    't_ship_his.car_num',
                    'm_worker.worker_name',
                    'm_worker.store_name']);

            if ($condition->lot_no != '') {
                $results->where('t_ship_his_detail.lot_no', 'LIKE', $condition->lot_no);
            }
            if ($condition->actual_vote != '') {
                $results->where('t_ship_his_detail.actual_vote', '=', $condition->actual_vote);
            }
            if ($condition->work_date_from != '' && $condition->work_date_to != '') {
                $results->whereBetween('t_ship_his.work_date', [date(DATE_FORMAT . '  00:00:00', strtotime($condition->work_date_from)), date(DATE_FORMAT . '  23:59:59', strtotime($condition->work_date_to))]);
            }
            if ($condition->ship_des_id != '') {
                $results->where('t_ship_his.ship_des_id', '=', $condition->ship_des_id);
            }
            if ($condition->worker_id != '') {
                $results->where('m_worker.worker_id', '=', $condition->worker_id);
            }
            if ($condition->ship_grp_key != '') {
                // echo $condition->ship_grp_key;exit;
                $results->where('t_ship_his.ship_des_id', 'LIKE', $condition->ship_grp_key . '%');
            }
            $results->orderBy('id', 'desc');
            $total = $results->count();
            if ($page != 0) {
                $results->offset($offset)
                    ->limit($limit);
            }
            //echo $results->toSql();exit;
            $data = $results->get();

            $paginate = new LengthAwarePaginator($data, $total, $limit, $page);
            return $paginate;

        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function export(TShipHisSearch $condition = null)
    {
        try {

            $model = $this->search($condition, 0);
            $export_collections = [];
            $export_collections[] = [
                '出庫日',
                '納品日',
                'ロットNo',
                '現品票No',
                'PL枚数',
                '出庫先',
                '車番',
                '出庫時刻',
                '作業者名',
                '出庫元'
            ];

            foreach ($model as $key => $row) {
                $export_collections[] = [
                    $row->work_date == null ? '' : date(DATE_FORMAT_CSV,  strtotime($row->work_date)),
                    $row->ship_date == null ? '' : date(DATE_FORMAT, strtotime($row->ship_date)),
                    $row->lot_no,
                    $row->actual_vote,
                    $row->index.'/'.$row->palette_plan,
                    $row->ship_des_name,
                    $row->car_num,
                    $row->ship_date == null ? '' : date('H:i', strtotime($row->ship_date)),
                    $row->worker_name,
                    $row->store_name
                ];
            }

            return export_to_csv($export_collections);


        } catch (\Throwable $e) {
            throw $e;
        }
    }
}

