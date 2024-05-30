<?php

require_once __DIR__ . '/../conn/conn.php';
require_once __DIR__ . '/../DAO/ProdutoDAO.php';
require_once __DIR__ . '/../view/ProdutoView.php';

class ProdutoController
{
    protected $pdo = null;
    protected ProdutoDAO $produtoDAO;
    protected ProdutoView $produtoView;

    public function __construct()
    {
        $this->pdo = connect();
        $this->produtoDAO = new ProdutoDAO($this->pdo);
        $this->produtoView = new ProdutoView();
    }

    public function obterTodosProdutos()
    {
        try {
            $produto = $this->produtoDAO->obterTodosProdutos();
            $this->produtoView->retornarEmJson($produto);
        } catch (Exception $erro) {
            $this->produtoView->retornarEmJson(['message' => 'Erro em retornar produtos: ', $erro->getMessage()]);
        }
    }

    public function obterMaisVendidos()
    {
        try {
            $produto = $this->produtoDAO->obterMaisVendidos();
            $this->produtoView->retornarEmJson($produto);
        } catch (Exception $erro) {
            $this->produtoView->retornarEmJson(['message' => 'Erro em retornar produtos: ', $erro->getMessage()]);
        }
    }
}
