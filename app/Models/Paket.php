<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
     protected $fillable = [
	    'id_member','nama_paket','lokasi', 'deskripsi', 'harga'
    ];
}
