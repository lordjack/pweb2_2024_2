<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    function index()
    {
        //select * from
        $dados = Curso::All();

        return view('curso.list', [
            'dados' => $dados
        ]);
    }

    function create()
    {
        return view('curso.form');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|max:150|min:3',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 130",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
            ]
        );

        $data = $request->all();

        Curso::create($data);

        return redirect('curso');
    }

    function edit($id)
    {
        $dado = Curso::find($id);

        return view('curso.form', [
            'dado' => $dado,
        ]);
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'nome' => 'required|max:150|min:3',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 130",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
            ]
        );

        $data = $request->all();

        Curso::updateOrCreate(
            ['id' => $id],
            $data
        );

        return redirect('curso');
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);

        $curso->delete();

        return redirect('curso');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Curso::where(
                $request->tipo,
                'like',
                "%$request->valor%"

            )->get();
        } else {
            $dados = Curso::All();
        }
        return view('curso.list', ['dados' => $dados]);
    }
}
