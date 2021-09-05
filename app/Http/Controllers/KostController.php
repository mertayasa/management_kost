<?php

namespace App\Http\Controllers;

use App\DataTables\KostDataTable;
use App\Http\Requests\KostStoreRequest;
use App\Http\Requests\KostUpdateRequest;
use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('kost.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $kosts = Kost::all();

        return KostDataTable::set($kosts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('kost.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kost $kost
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kost $kost)
    {
        return view('kost.edit', compact('kost'));
    }

    /**
     * @param \App\Http\Requests\KostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KostStoreRequest $request)
    {
        $kost = Kost::create($request->validated());

        return redirect()->route('kost.index');
    }

    /**
     * @param \App\Http\Requests\KostUpdateRequest $request
     * @param \App\Models\Kost $kost
     * @return \Illuminate\Http\Response
     */
    public function update(KostUpdateRequest $request, Kost $kost)
    {
        $kost->update($request->validated());

        return redirect()->route('kost.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kost $kost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kost $kost)
    {
        $kost->delete();
    }
}
