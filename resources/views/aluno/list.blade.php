<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{route('aluno.search')}}" method="post">
    @csrf
    <select name="tipo">
        <option value="nome">Nome</option>
        <option value="cpf">CPF</option>
        <option value="telefone">Telefone</option>
    </select>
    <input type="text" name="valor">
    <button type="submit">Buscar</button>
    <button><a href="{{ url('aluno/create') }}">Novo</a></button>
</form>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Categoria</th>
            <th>Ação</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dados as $item )
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nome}}</td>
                <td>{{$item->cpf}}</td>
                <td>{{$item->telefone}}</td>
                <td>{{$item->categoria->nome ?? ""}}</td>
                <td><a href="{{route('aluno.edit',$item->id)}}">Editar</a></td>
                <td>
                    <form action=" {{route('aluno.destroy',$item->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                            onclick="return confirm('Deseja remover o registro?')"
                        >
                        Deletar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
