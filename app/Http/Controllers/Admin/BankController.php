<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Bank;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$banks = Bank::all();
    	return view('admin.bank', compact('banks'));
    }
    public function validasi(Request $request)
    {
      $this->validate($request, [
        'bank' => 'required|max:40',
        'no_rek' => 'bail|required|max:18|regex:/([0-9]+){8,17}/u',
      ]);
    }
    public function store(Request $request)
    {
        $this->validasi($request);

        $bank = new Bank();
        $bank->fill($request->all());
        $bank->save();
        return back()->with('success', 'Berhasil Menambahkan Bank');
    }

    public function update(Request $request)
    {
        $this->validasi($request);

        $bank = Bank::find($request->id);
        $bank->fill($request->all());
        $bank->save();
        return back()->with('success', 'Berhasil Mengupdate Bank');
    }
    public function delete($id)
    {
        $bank = Bank::find($id)->delete();
        return redirect('admin/bank')->with('success', 'Berhasil Menghapus Bank');
    }
}
