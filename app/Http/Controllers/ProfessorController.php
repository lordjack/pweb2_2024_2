<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    function index()
    {
        //select * from
        $dados = Professor::All();

        return view('professor.list', [
            'dados' => $dados
        ]);
    }

    function create()
    {
        return view('professor.form');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|max:120|min:3',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 120",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
            ]
        );

        $data = $request->all();

        Professor::create($data);

        return redirect('professor');
    }

    function edit($id)
    {
        $dado = Professor::find($id);

        return view('professor.form', [
            'dado' => $dado,
        ]);
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'nome' => 'required|max:120|min:3',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 120",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
            ]
        );

        $data = $request->all();

        Professor::updateOrCreate(
            ['id' => $id],
            $data
        );

        return redirect('professor');
    }

    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);

        $professor->delete();

        return redirect('professor');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Professor::where(
                $request->tipo,
                'like',
                "%$request->valor%"

            )->get();
        } else {
            $dados = Professor::All();
        }
        return view('professor.list', ['dados' => $dados]);
    }
}
