@extends('base')
@section('titulo', 'Listagem Alunos')
@section('conteudo')

    <h3>Listagem Alunos</h3>
    <div class="row mb-4">
        <form action="{{ route('aluno.search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-3">
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="cpf">CPF</option>
                        <option value="telefone">Telefone</option>
                    </select>
                </div>
                <div class="col-5">
                    <input type="text" name="valor" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                    <a class="btn btn-success" href="{{ url('aluno/create') }}"><i class="fa-solid fa-plus"></i> Novo</a>
                    <a class="btn btn-danger" href="{{ url('aluno/report') }}"><i class="fa-regular fa-file-pdf"></i> Gerar Relatório</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Imagem</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)
                    @php
                        $nome_imagem = !empty($item->imagem) ? $item->imagem : 'sem_imagem.jpg';
                    @endphp
                    <tr>
                        <td scope="row">{{ $item->id }}</td>
                        <td><img src="/storage/{{ $nome_imagem }}" width="80px" alt="imagem"></td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->cpf }}</td>
                        <td>{{ $item->telefone }}</td>
                        <td>{{ $item->categoria->nome ?? '' }}</td>
                        <td><a class="btn btn-warning" href="{{ route('aluno.edit', $item->id) }}" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td>
                            <form action=" {{ route('aluno.destroy', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Deseja remover o registro?')" title="Remover">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
