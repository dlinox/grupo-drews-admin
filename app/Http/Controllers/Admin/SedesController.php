<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use Illuminate\Http\Request;

class SedesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'sedes.*.ubigeo' => 'required',
            ],
            [
                'sedes.*.ubigeo' =>  'Ubigeo :index  obligatorio',

            ]
        );

        foreach ($request->sedes as  $value) {

            if ($value['id']) {
                Sede::where('id', $value['id'])->update($value);
            } else {
                Sede::create($value);
            }
        }


        return back()->withInput($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        Sede::find($id)->delete();
        return back();
    }
}
