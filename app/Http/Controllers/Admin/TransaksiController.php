<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
