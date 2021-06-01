<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MShipGroup extends Model
{
    use HasFactory;
    protected $table = 'm_ship_grp';
    public $timestamps = false;

    //protected $primaryKey = 'ship_grp_key';

}
