<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$kategoris = Kategori::all();
    	return view('admin.kategori', compact('kategoris'));
    }
    public function store(Request $request)
    {
        $kategori = new Kategori();
        $kategori->fill($request->all());
        $kategori->save();
        return back()->with('success', 'Berhasil Menambahkan Kategori');
    }

    public function update(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $kategori->fill($request->all());
        $kategori->save();
        return back()->with('success', 'Berhasil Mengupdate Kategori');
    }
    public function delete($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect('admin/kategori')->with('success', 'Berhasil Menghapus Kategori');
    }
}
