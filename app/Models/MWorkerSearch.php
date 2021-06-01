<?php

namespace App\Models;

class MWorkerSearch
{
    public $worker_id;
    public $worker_name;
    public $store_name;

    private $validate = true;
    public $errors;

    /**
     * MWorkerSearch constructor.
     */
    public function __construct()
    {
        $this->worker_id = '';
        $this->worker_name = '';
        $this->store_name = '';
    }

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
        try{

            $this->worker_id = $request['worker_id'];
            $this->worker_name = $request['worker_name'];
            $this->store_name = $request['store_name'];
        } catch (\Throwable $e) {
            $this->errors['sys'] = 'Errors model';
            $this->validate = false;
            throw $e;
        }
    }

}
