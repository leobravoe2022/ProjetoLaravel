<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Index de Produto</title>
</head>
<body>
    <div class="container">
        <a href="{{route("produto.create")}}" class="btn btn-primary">Criar um produto</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <th scope="row">{{$produto->id}}</th>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->preco}}</td>
                        <td>{{$produto->descricao}}</td>
                        <td>
                            <a href="{{route("produto.show", $produto->id)}}" class="btn btn-primary">Mostrar</a>
                            <a href="{{route("produto.edit", $produto->id)}}" class="btn btn-secondary">Editar</a>
                            <button type="button" class="btn btn-danger btnRemover" data-bs-toggle="modal" 
                                    data-bs-target="#exampleModal" value="{{route("produto.destroy", $produto->id)}}">Remover</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remoção de recurso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja realmente remover este recurso?
                    </div>
                    <div class="modal-footer">
                        <form id="id-form-modal-botao-remover" method="post" action="" style="display: inline;">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="submit" value="Confirmar" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script>
        // Declaro uma variável para receber todos os botões remover da página
        // Faço isso buscando todos os botão que estão configurados com a class btnRemover (.btnRemover)
        let arrayBotaoRemover = document.querySelectorAll(".btnRemover");
        // Crio uma referência para o elemento do HTML no Javascript
        let formModalBotaoRemover = document.querySelector("#id-form-modal-botao-remover");
        // console.log(arrayBotaoRemover);
        // Como arrayBotaoRemover é um array, posso utilizar o forEach para percorrer todos os elementos
        arrayBotaoRemover.forEach(element => {
            // Para cada vez que o laço é executado, no botão é adicionado um novo evento de escuta.
            // Esse evento irá escutar um click sobre o botão, quando esse click acontecer, a função configuraBotaoRemoverModal é executada
            element.addEventListener('click', configuraBotaoRemoverModal);
        });
        function configuraBotaoRemoverModal(){
            // O this em uma função faz referência ao elemento (objeto) que chamou essa função.
            // console.log( this.getAttribute("value") );
            // Modifico o atributo "action" dentro do form com o conteúdo do "value" escondido dentro do botão.
            formModalBotaoRemover.setAttribute("action", this.getAttribute("value"));
        }
    </script>

</body>
</html>