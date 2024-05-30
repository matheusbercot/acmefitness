<?php

require_once __DIR__ . '..\..\model\Produto.php';
require_once __DIR__ . '..\..\DAO\CategoriaDAO.php';

class ProdutoDAO
{
    protected $pdo = null;
    public $categoriaDAO = null;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->categoriaDAO = new CategoriaDAO($pdo);
    }
    public function obterPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->execute(["id" => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $produto = $this->transformarEmProduto($resultado);
        return $produto;
    }

    public function obterTodosProdutos()
    {

        $produtos = [];
        $stmt = $this->pdo->prepare('SELECT * FROM produtos');
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $resultado) {
            $produtos[] = $this->transformarEmProduto($resultado);
        }
        return $produtos;
    }

    public function obterMaisVendidos()
    {
        $stmt = $this->pdo->prepare('SELECT p.* ,t.produto_id as variacao_id , SUM(t.quantidade_vendas) AS total_vendas FROM variacoes t JOIN
        produtos p on t.produto_id = p.id 
        GROUP BY produto_id ORDER BY total_vendas DESC LIMIT 3;');
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $variacoes = [];
        foreach ($resultados as $resultado) {
            $variacoes[] = $this->transformarEmProduto($resultado);
        }
        return $variacoes;
    }


    function transformarEmProduto($resultado)
    {
       $produto = new Produto(
            $resultado['id'],
            $resultado['codigo'],
            $resultado['nome'],
            $resultado['cor'],
            $resultado['imagem'],
            $resultado['preco'],
            $resultado['descricao'],
            $resultado['data_cadastro'],
            $resultado['peso'],
            $this->obterCategoria($resultado['categoria_id'])
        );

        return $produto;
    }

    public function obterCategoria($id)
    {
        return $this->categoriaDAO->obterPorId($id);
    }
}
