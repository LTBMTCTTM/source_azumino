<?php


namespace App\Models;


class TShipHisSearch
{
    public $lot_no;
    public $actual_vote;
    public $work_date_from;
    public $work_date_to;
    public $create_date_to;
    public $create_date_from;
    public $ship_des_id;
    public $worker_id;
    public $ship_grp_key;

    private $validate = true;
    public $errors;
    public function __construct()
    {
        $this->lot_no = '';
        $this->actual_vote = '';
        $this->work_date_from = '';
        $this->work_date_to = '';
        $this->ship_des_id = '';
        $this->worker_id = '';
        $this->ship_grp_key = '';
    }

    /**
     * @param string $lot_no
     */
    public function setLotNo($lot_no)
    {
        $this->lot_no = $lot_no;
    }

    /**
     * @param string $actual_vote
     */
    public function setActualVote($actual_vote)
    {
        $this->actual_vote = $actual_vote;
    }

    /**
     * @param string $ship_des_id
     */
    public function setShipDesName($ship_des_id)
    {
        $this->ship_des_id = $ship_des_id;
    }

    /**
     * @param string $worker_id
     */
    public function setWorkerName($worker_id)
    {
        $this->worker_id = $worker_id;
    }

    /**
     * @param mixed $create_date_to
     */
    public function setCreateDateTo($create_date_to): void
    {
        if ($create_date_to==''){
            $this->create_date_to = $this->create_date_from;
            return;
        }
        $this->create_date_to = $create_date_to;
    }

    /**
     * @param mixed $create_date_from
     */
    public function setCreateDateFrom($create_date_from): void
    {
        $this->create_date_from = $create_date_from;
    }

    /**
     * @param $request
     * @return bool
     */
    public function isValidate($request)
    {
        $this->load($request);
        return $this->validate;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function load($request){
        $this->lot_no = $request['lot_no'];
        $this->actual_vote = $request['actual_vote'];
        $this->setCreateDateFrom($request['create_date_from']);
        $this->setCreateDateTo($request['create_date_to']);
        $this->ship_des_id = $request['ship_des_id'];
        $this->worker_id = $request['worker_id'];
        $this->ship_grp_key = $request['ship_grp_key'];
    }

}
