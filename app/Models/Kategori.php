<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
     protected $fillable = [
	    'slug_kategori','kategori','status'
    ];
    public $timestamps = false;
}
