<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Index de Tipo Produto</title>
</head>
<body>
    <div class="container">
        <a href="{{route("tipoproduto.create")}}" class="btn btn-primary">Criar um tipo produto</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipoProdutos as $tipoProduto)
                    <tr>
                        <th scope="row">{{$tipoProduto->id}}</th>
                        <td>{{$tipoProduto->descricao}}</td>
                        <td>
                            <a href="{{route("tipoproduto.show", $tipoProduto->id)}}" class="btn btn-primary">Mostrar</a>
                            <a href="{{route("tipoproduto.edit", $tipoProduto->id)}}" class="btn btn-secondary">Editar</a>
                            <form method="post" action="{{route("tipoproduto.destroy", $tipoProduto->id)}}" style="display: inline;">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="submit" value="Remover" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>