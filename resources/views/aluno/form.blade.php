<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h3>Formulário Aluno</h3>

    <div>
        @if ($errors->any())
            <b>Por favor, verifique os erros abaixo</b>
            <ul>
                @foreach ($errors->all() as $error  )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    @php
        if(!empty($dado->id)){
            $route = route('aluno.update', $dado->id);
        } else{
            $route = route('aluno.store');
        }
    @endphp

    <form action="{{ $route }}" method="post"
            enctype="multipart/form-data">
        <!-- csrf camada de segurança-->
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id"
            value="@if(!empty($dado->id)){{$dado->id}}
            @else{{''}}@endif"
        >

        <label>Nome</label><br>
        <input type="text" name="nome"
            value="@if(!empty($dado->nome)){{$dado->nome}}
            @elseif (!empty(old('nome'))){{old('nome')}}
            @else{{''}}@endif"><br>

        <label>CPF</label><br>
        <input type="text" name="cpf"
            value="@if(!empty($dado->cpf)){{$dado->cpf}}
            @elseif (!empty(old('cpf'))){{old('cpf')}}
            @else{{''}}@endif"><br>

        <label>Telefone</label><br>
        <input type="text" name="telefone"
            value="@if(!empty($dado->telefone)){{$dado->telefone}}
            @elseif (!empty(old('telefone'))){{old('telefone')}}
            @else{{''}}@endif"><br>

        <label>Categoria</label><br>
        <select name="categoria_id">
            @foreach ($categorias as $categoria)
                <option
                    @if(!empty($dado->categoria_id) &&
                     $dado->categoria_id == $categoria->id){{"selected"}}
                    @endif
                value="{{$categoria->id}}">{{$categoria->nome}}</option>
            @endforeach
        </select><br>

        @php
            $nome_imagem = !empty($dado->imagem) ? $dado->imagem
                : "sem_imagem.jpg";
        @endphp

        <label>Imagem</label><br>
        <img src="/storage/{{$nome_imagem}}" width="300px" alt="imagem">
        <input type="file" name="imagem"
            value="@if(!empty($dado->imagem)){{$dado->imagem}}
            @elseif(!empty(old('imagem'))){{old('imagem')}}
            @else{{''}}@endif"><br>


        <button type="submit">Salvar</button>
        <button><a href="{{ url('aluno') }}">Voltar</a></button>
    </form>

</body>
</html>
