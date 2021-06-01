<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MShipDestSearch
{
    public $ship_des_id;
    public $ship_des_name;
    public $ship_grp_key;
    public $ship_des_tel;

    private $validate = true;
    public $errors;
    /**
     * MShipDestSearch constructor.
     *
     */
    public function __construct()
    {
        $this->ship_des_id = '';
        $this->ship_des_name = '';
        $this->ship_grp_key = '';
        $this->ship_des_tel = '';
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

            $this->ship_des_id = $request['ship_des_id'];
            $this->ship_des_name = $request['ship_des_name'];
            $this->ship_grp_key = $request['ship_grp_key'];
            $this->ship_des_tel = $request['ship_des_tel'];
        } catch (\Throwable $e) {
            $this->errors['sys'] = 'Errors model';
            $this->validate = false;
            throw $e;
        }
    }
}
