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

    function edit($id)
    {
        $dado = Aluno::find($id);

        return view('aluno.form', [
            'dado' => $dado
        ]);
    }

}
