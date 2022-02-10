<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\DB;

class TipoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Mostra uma lista de todos os Tipos de Produto
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoProdutos = DB::select("SELECT * FROM tipo_produtos");
        return view("TipoProduto/index")->with('tipoProdutos', $tipoProdutos);
    }

    /**
     * Show the form for creating a new resource.
     * Mostrar o formulário para criação de um novo Tipo de Produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("TipoProduto/create");
    }

    /**
     * Store a newly created resource in storage.
     * Armazena um novo Tipo de Produto no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "O método Store de Tipo Produto foi chamado <br>";
        //echo "$request->_token <br>";
        //echo "$request->descricao <br>";

        // Quando apertamos no botão "salvar" o formulário é enviado para a rota e é transformoado na variável $request
        // Dentro da variável $request estarão todos as tags com a propriedas "name" definidas

        $tipoProduto = new TipoProduto();
        $tipoProduto->descricao = $request->descricao;
        $tipoProduto->save();

        return $this->index();
    }

    /**
     * Display the specified resource.
     * Mostrar um Tipo de Produto com base em um ID específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoProduto = TipoProduto::find($id);
        if($tipoProduto){
            return view("TipoProduto/show")->with("tipoProduto", $tipoProduto);
        }
        else {
            return "TipoProduto não encontrado";
        }
    }

    /**
     * Show the form for editing the specified resource.
     * Mostra o formulário para edição de um Tipo de Produto específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoProduto = TipoProduto::find($id); // Retorna um objeto
        if( isset($tipoProduto) ) {
            return view("TipoProduto/edit")->with("tipoProduto", $tipoProduto);
        }
        else {
            return "Tipo Produto não encontrado";
        }
    }

    /**
     * Update the specified resource in storage.
     * Atutualiza um Tipo de Recurso específico no Banco de Dados
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoProduto = TipoProduto::find($id);
        if(isset($tipoProduto)){
            $tipoProduto->descricao = $request->descricao;
            $tipoProduto->update();
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     * Remove um Tipo de Produto do Banco de Dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo "Método destroy chamado <br>";
        $tipoProduto = TipoProduto::find($id);
        //print_r($produto);
        // Se o produto foi encontrado
        if( isset($tipoProduto) ){
            $tipoProduto->delete();
        }
        return $this->index();
    }
}
