<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    function index()
    {
        //select * from
        $dados = Aluno::All();

        return view('aluno.list',[
            'dados'=>$dados
        ]);
    }

    function create()
    {
        return view('aluno.form');
    }

    function store(Request $request){

        $request->validate(
            [
                'nome'=>'required|max:130|min:3',
                'cpf'=>'required|max:14',
                'telefone'=>'required|max:20',
            ],[
                'nome.required' =>" O :attribute é obrigatório",
                'nome.max' =>" O máximo de caracteres para :attribute é 130",
                'nome.min' =>" O mínimo de caracteres para :attribute é 3",
                'cpf.required' =>" O :attribute é obrigatório",
                'cpf.max' =>" O máximo de caracteres para :attribute é 14",
                'telefone.required' =>" O :attribute é obrigatório",
                'telefone.max' =>" O máximo de caracteres para :attribute é 20",
            ]
        );

        //$data = $request->all();
        $data = [
            'nome'=> $request->nome,
            'cpf'=> $request->cpf,
            'telefone'=> $request->telefone,
        ];

        Aluno::create($data);

        return redirect('aluno');
    }

    function edit($id)
    {
        $dado = Aluno::find($id);

        return view('aluno.form', [
            'dado' => $dado
        ]);
    }

    function update(Request $request, $id){

        $request->validate(
            [
                'nome'=>'required|max:130|min:3',
                'cpf'=>'required|max:14',
                'telefone'=>'required|max:20',
            ],[
                'nome.required' =>" O :attribute é obrigatório",
                'nome.max' =>" O máximo de caracteres para :attribute é 130",
                'nome.min' =>" O mínimo de caracteres para :attribute é 3",
                'cpf.required' =>" O :attribute é obrigatório",
                'cpf.max' =>" O máximo de caracteres para :attribute é 14",
                'telefone.required' =>" O :attribute é obrigatório",
                'telefone.max' =>" O máximo de caracteres para :attribute é 20",
            ]
        );

        //$data = $request->all();
        $data = [
            'nome'=> $request->nome,
            'cpf'=> $request->cpf,
            'telefone'=> $request->telefone,
        ];

        Aluno::updateOrCreate(
            ['id'=>$id], $data
        );

        return redirect('aluno');
    }

}
