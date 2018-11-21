<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $fillable = [
	    'id_member','saldo_awal','debit','kredit','saldo_akhir','keterangan'
    ];
}
