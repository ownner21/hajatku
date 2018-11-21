<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketPengiriman extends Model
{
     protected $fillable = [
	    'id_paket','id_lokasi','tagihan'
	];
}
