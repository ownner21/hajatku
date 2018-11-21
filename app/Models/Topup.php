<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $fillable = [
	    'id_member', 'bank' ,'nominal','status'
	];
}
