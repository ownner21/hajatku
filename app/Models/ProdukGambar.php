<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukGambar extends Model
{
     protected $fillable = [
	    'id_produk','gambar'
    ];
    public $timestamps = false;
}
