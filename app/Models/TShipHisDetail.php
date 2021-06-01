<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TShipHisDetail extends Model
{
    use HasFactory;

    protected $table = 't_ship_his_detail';

    public $timestamps = false;
    protected $fillable = [
        'id',
        'index',
        'lot_no',
        'actual_vote'
    ];
}
