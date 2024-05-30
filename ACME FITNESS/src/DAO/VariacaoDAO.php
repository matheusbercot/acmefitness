<?php

require_once __DIR__ . '..\..\model\Variacao.php';
require_once __DIR__ . '..\..\DAO\ProdutoDAO.php';

class VariacaoDAO
{

    protected $pdo = null;
    private $produtoDAO = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->produtoDAO = new ProdutoDAO($pdo);
    }

    public function atualizarEstoque($id, $quantidade) {

        $stmt = $this->pdo->prepare("UPDATE variacoes SET quantidade_estoque = quantidade_estoque - :quantidade, quantidade_vendas = quantidade_vendas + :quantidade WHERE id = :variacao_id");
        $stmt->execute([
            'quantidade' => $quantidade,
            'variacao_id' => $id,
        ]);
    }


    public function obterPorId($variacao)
    {
        $id = $variacao['id'];
        $stmt = $this->pdo->prepare("SELECT * FROM variacoes WHERE id = :id");
        $stmt->execute(["id" => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $variacao = $this->transformarEmVariacao($resultado);
        return $variacao;
    }


    public function obterPrecoPorId($variacao)
    {


        $stmt = $this->pdo->prepare("SELECT preco FROM variacoes v join produtos p on p.id = v.produto_id WHERE p.id = :id");
        $stmt->execute(["id" => $variacao]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }


    public function obterVariacaos()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM variacoes');
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $variacoes = [];
        foreach ($resultados as $resultado) {
            $variacoes[] = $this->transformarEmVariacao($resultado);
        }
        return $variacoes;
    }


    function transformarEmVariacao($resultado)
    {
       $variacao = new Variacao(
            $resultado['id'],
            $resultado['nome'],
            $resultado['quantidade_estoque'],
            $this->obterProduto($resultado['produto_id']),
            $resultado['quantidade_vendas']
        );


        return $variacao;
    }

    public function obterProduto($id)
    {
        return $this->produtoDAO->obterPorId($id);
    }
}
