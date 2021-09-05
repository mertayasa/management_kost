<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengeluaranStoreRequest;
use App\Http\Requests\PengeluaranUpdateRequest;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pengeluaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $pengeluarans = Pengeluaran::all();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pengeluaran.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    /**
     * @param \App\Http\Requests\PengeluaranStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengeluaranStoreRequest $request)
    {
        $pengeluaran = Pengeluaran::create($request->validated());

        return redirect()->route('pengeluaran.index');
    }

    /**
     * @param \App\Http\Requests\PengeluaranUpdateRequest $request
     * @param \App\Models\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(PengeluaranUpdateRequest $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->update($request->validated());

        return redirect()->route('pengeluaran.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pengeluaran $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
    }
}
