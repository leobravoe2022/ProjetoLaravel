<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Mostra uma lista de todos os Produtos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Uma consulta no banco de dados utilizando o DB sempre retorna um array (vetor)
        // [ objeto1 = (1, pepperoni, 50.50, 1, ..., ...), objeto2, objeto3 ]
        // Essa consulta junta o resultado de produtos e tipo_produtos
        $produtos = DB::select("SELECT Produtos.id, 
                                       Produtos.nome,
                                       Produtos.preco,
                                       Produtos.Tipo_Produtos_id,
                                       Tipo_Produtos.descricao
                                FROM Produtos
                                JOIN Tipo_Produtos 
                                ON Produtos.Tipo_Produtos_id = Tipo_Produtos.id
                                ORDER BY Produtos.id");
        //print_r($produtos);
        return view("Produto/index")->with('produtos', $produtos);
    }

    /**
     * Show the form for creating a new resource.
     * Mostra um formulário para criação de um novo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Utilizo a classe DB para realizar uma busca no banco de dados e armazeno o resultado na variável $tipoProdutos.
        // A variável $tipoProdutos é um array(vetor), ou serja, [tipo1, tipo2, tipo3]
        $tipoProdutos = DB::select("SELECT * FROM tipo_produtos");
        //Imprimo o array $tipoProdutos para ver seu conteúdo
        //print_r($tipoProdutos);
        // Carrego a view create de Produto passando o array $tipoProdutos
        return view("Produto/create")->with("tipoProdutos", $tipoProdutos);
    }

    /**
     * Store a newly created resource in storage.
     * Salva um recurso recentemente criado no banco. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->nome = "Pepperoni"
        // $request->preco = 50.50
        // $request->Tipo_Produtos_id = 1

        if($request->Tipo_Produtos_id != "null")
        {
            $produto = new Produto();
            $produto->nome = $request->nome;
            $produto->preco = $request->preco;
            $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
            $produto->save();
        }

        // Retorna a execução do método index()
        return $this->index();
    }

    /**
     * Display the specified resource.
     * Mostra o recurso específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo $id;
        // Buscas no Banco utilizando models (anteriormente utilizamos a classe DB)
        // O parâmetro passado para o método find, deve ser a chave primária da tabela
        $produto = Produto::find($id);
        // Quando utilizamos buscas utilizando models, o objeto retornado é mais completo que 
        // os objetos retornados quando utilizamos a classe DB.
        // print_r($produto);
        // Rotina que irá controlar se o $id buscado existe ou não
        if( isset($produto) )
        {
            $tipoProdutos = TipoProduto::all();
            // $tipoProdutos = DB::select("SELECT * FROM tipo_produtos"); faz quase a mesma coisa que a linha de cima
            return view("Produto/show")->with("produto", $produto)->with("tipoProdutos", $tipoProdutos);
        }
        else{
            // Tratar itens não encontrados no futuro
            echo "Produto não encontrado";
        }
    }

    /**
     * Show the form for editing the specified resource.
     * Mostrar o formulário para editar o recurso específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo "Método edit de Produto chamado com id: $id <br>";
        $produto = Produto::find($id); // Retorna um objeto
        // $produto = Produto::where('Tipo_Produtos_id', 1)->get(); // Retorna um array
        // $produto = DB::select("SELECT * FROM PRODUTOS WHERE id = ?", [$id])[0]; // Retorna um objeto (por causa do [0])
        // $produtos = DB::select("SELECT * FROM PRODUTOS WHERE preco = ?", [8]); // Retorna um array
        // foreach($produtos as $produto) {
        //     print_r($produto);
        //     echo '<br><br>';
        // }
        // print_r($produto);
        if( isset($produto) ) {
            $tipoProdutos = TipoProduto::all();
            return view("Produto/edit")->with("produto", $produto)->with("tipoProdutos", $tipoProdutos);
        }
        else {
            return "Produto não encontrado";
        }
    }

    /**
     * Update the specified resource in storage.
     * Atualiza o recurso específico no banco.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        //$produto = DB::select('select * from produtos where id = ?', [$id]);
        //print_r($produto);
        //$produto->update();
        if(isset($produto)){
            $produto->nome = $request->nome;
            $produto->preco = $request->preco;
            $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
            $produto->update();
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo "Método destroy chamado <br>";
        $produto = Produto::find($id);
        //print_r($produto);
        // Se o produto foi encontrado
        if( isset($produto) ){
            $produto->delete();
        }
        return $this->index();
    }
}
