<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$lokasis = Lokasi::all();
    	return view('admin.lokasi', compact('lokasis'));
    }
    public function store(Request $request)
    {
        $lokasi = new Lokasi();
        $lokasi->fill($request->all());
        $lokasi->save();
        return back()->with('success', 'Berhasil Menambahkan Lokasi ');
    }

    public function update(Request $request)
    {
        $lokasi = Lokasi::find($request->id);
        $lokasi->fill($request->all());
        $lokasi->save();
        return back()->with('success', 'Berhasil Mengupdate Lokasi');
    }
    public function delete($id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->delete();
        return back()->with('success', 'Berhasil Menghapus Lokasi');
    }
}
