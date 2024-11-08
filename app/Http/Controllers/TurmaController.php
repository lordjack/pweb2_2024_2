<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Turma;
use App\Models\Curso;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    function index()
    {
        //select * from
        $dados = Turma::All();

        return view('turma.list', [
            'dados' => $dados
        ]);
    }

    function create()
    {
        $professores = Professor::All();
        $cursos = Curso::All();

        return view('turma.form', [
            'professores' => $professores,
            'cursos' => $cursos,
        ]);
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|max:150|min:3',
                'professor_id' => 'required',
                'curso_id' => 'required',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 150",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                'professor_id.required' => " O :attribute é obrigatório",
                'curso_id.required' => " O :attribute é obrigatório",
            ]
        );

        $data = $request->all();

        Turma::create($data);

        return redirect('turma');
    }

    function edit($id)
    {
        $dado = Turma::find($id);

        $professores = Professor::All();
        $cursos = Curso::All();

        return view('turma.form', [
            'dado' => $dado,
            'professores' => $professores,
            'cursos' => $cursos,
        ]);
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'nome' => 'required|max:150|min:3',
                'professor_id' => 'required',
                'curso_id' => 'required',
            ],
            [
                'nome.required' => " O :attribute é obrigatório",
                'nome.max' => " O máximo de caracteres para :attribute é 150",
                'nome.min' => " O mínimo de caracteres para :attribute é 3",
                'professor_id.required' => " O :attribute é obrigatório",
                'curso_id.required' => " O :attribute é obrigatório",
            ]
        );

        $data = $request->all();

        Turma::updateOrCreate(
            ['id' => $id],
            $data
        );

        return redirect('turma');
    }

    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);

        $turma->delete();

        return redirect('professor');
    }

    public function search(Request $request)
    {
        $query = Turma::with(['curso', 'professor']);

        if (!empty($request->valor)) {
            if ($request->tipo === 'curso') {
                $query->whereHas('curso', function ($q) use ($request) {
                    $q->where('nome', 'like', "%$request->valor%");
                });
            } else if ($request->tipo === 'professor') {
                $query->whereHas('professor', function ($q) use ($request) {
                    $q->where('nome', 'like', "%$request->valor%");
                });
            } else {
                $query->where(
                    $request->tipo,
                    'like',
                    "%$request->valor%"

                );
            }

            $dados = $query->get();

        } else {
            $dados = Turma::All();
        }
        return view('turma.list', ['dados' => $dados]);
    }
}
