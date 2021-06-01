<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class MWorker extends Model
{
    use HasFactory;

    protected $table = 'm_worker';
    protected $primaryKey = 'worker_id';

    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = [
        'last_update',
    ];

    public function search(MWorkerSearch $condition = null, $page = 1)
    {
        try {
            $limit = PAGE_LIMITS;
            $offset = $page != 0 ? ($page * $limit) - $limit : 0;

            $results = $this::query();
            if ($condition->worker_id != '') {
                $results->where($this->table.'.worker_id', '=', $condition->worker_id);
            }
            if ($condition->worker_name != '') {
                $results->where($this->table.'.worker_name', 'LIKE', '%' . $condition->worker_name . '%');
            }
            if ($condition->store_name != '') {
                $results->where($this->table.'.store_name', 'LIKE', '%' . $condition->store_name . '%');
            }

            $results->orderBy('create_date', 'desc');
            $results->orderBy('last_update', 'desc');
            $total = $results->count();
            if ($page != 0) {
                $results->offset($offset)
                    ->limit($limit);
            }
            //echo $results->toSql();exit;
            $data = $results->get();
            return new LengthAwarePaginator($data, $total, $limit, $page);

        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
