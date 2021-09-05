<?php

namespace App\Http\Controllers;

use App\DataTables\KamarDataTable;
use App\Http\Requests\KamarStoreRequest;
use App\Http\Requests\KamarUpdateRequest;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('kamar.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $kamars = Kamar::all();
        return KamarDataTable::set($kamars);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('kamar.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kamar $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kamar $kamar)
    {
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * @param \App\Http\Requests\KamarStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KamarStoreRequest $request)
    {
        $kamar = Kamar::create($request->validated());

        return redirect()->route('kamar.index');
    }

    /**
     * @param \App\Http\Requests\KamarUpdateRequest $request
     * @param \App\Models\Kamar $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(KamarUpdateRequest $request, Kamar $kamar)
    {
        $kamar->update($request->validated());

        return redirect()->route('kamar.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kamar $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kamar $kamar)
    {
        $kamar->delete();
    }
}
