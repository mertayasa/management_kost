<?php

namespace App\Http\Controllers;

use App\DataTables\SewaDataTable;
use App\Http\Requests\SewaStoreRequest;
use App\Http\Requests\SewaUpdateRequest;
use App\Models\Sewa;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('sewa.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $sewas = Sewa::all();

        return SewaDataTable::set($sewas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('sewa.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sewa $sewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sewa $sewa)
    {
        return view('sewa.edit', compact('sewa'));
    }

    /**
     * @param \App\Http\Requests\SewaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SewaStoreRequest $request)
    {
        $sewa = Sewa::create($request->validated());

        return redirect()->route('sewa.index');
    }

    /**
     * @param \App\Http\Requests\SewaUpdateRequest $request
     * @param \App\Models\Sewa $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(SewaUpdateRequest $request, Sewa $sewa)
    {
        $sewa->update($request->validated());

        return redirect()->route('sewa.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sewa $sewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sewa $sewa)
    {
        $sewa->delete();
    }
}
