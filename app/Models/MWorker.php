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
                $results->where($this->table.'.worker_id', '=', $condition->worker_id . '%');
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
