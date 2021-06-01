<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class MShipDest extends Model
{
    use HasFactory;

    protected $table = 'm_ship_des';
    protected $primaryKey = 'ship_des_id';

    public $timestamps = false;
    public $incrementing = false;

    protected $hidden = [
        'ship_allow_time',
        'last_update',
    ];


    public function search(MShipDestSearch $condition = null, $page = 1)
    {
        try {
            $limit = PAGE_LIMITS;
            $offset = $page != 0 ? ($page * $limit) - $limit : 0;

            $results = MShipDest::query();

            if ($condition->ship_grp_key != '') {
                $results->where('m_ship_des.ship_des_id', 'LIKE', $condition->ship_grp_key . '%');
            }
            if ($condition->ship_des_id != '') {
                $results->where('m_ship_des.ship_des_id', 'LIKE', '%' . $condition->ship_des_id);
            }
            if ($condition->ship_des_name != '') {
                $results->where('m_ship_des.ship_des_name', '=', $condition->ship_des_name);
            }
            if ($condition->ship_des_tel != '') {
                $results->where('m_ship_des.ship_des_tel', '=', $condition->ship_des_tel);
            }

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
}
