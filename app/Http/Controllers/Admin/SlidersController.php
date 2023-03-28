<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SlidersController extends Controller
{

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'sliders.*.titulo' => 'required',
                'sliders.*.tipo' => 'required',
            ],
            [
                'sliders.*.titulo.required' =>  'Titulo :index  obligatorio',
                'sliders.*.tipo.required' =>  'Tipo :index  obligatorio',
              

            ]
        );



        foreach ($request->sliders as $key => $value) {

            $data = [
                'titulo' => $value['titulo'],
                'sub_titulo' => $value['sub_titulo'],
                'tipo' => $value['tipo'],
                'grupo' => 0,
            ];

            if (file_exists($value['src'])) {

                $file_name = Str::random(8) . '-' . time() . '.' . $value['src']->extension();
                $value['src']->move(public_path('uploads/sliders/'), $file_name);

                $data['src'] = 'uploads/sliders/' . $file_name;
            }

            if ($value['id']) {

                Slider::where('id', $value['id'])->update($data);
            } else {
                Slider::create($data);
            }
        }


        return back()->withInput($request->all());
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        Slider::find($id)->delete();
        return back();
    }
}
