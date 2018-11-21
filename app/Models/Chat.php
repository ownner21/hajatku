<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
	    'id_member_pengirim','id_member_penerima','chat','lampiran'
    ];
}
