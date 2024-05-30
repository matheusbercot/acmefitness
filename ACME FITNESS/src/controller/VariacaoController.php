<?php

require_once __DIR__ . '/../conn/conn.php';
require_once __DIR__ . '/../DAO/VariacaoDAO.php';
require_once __DIR__ . '/../view/VariacaoView.php';

class VariacaoController
{
    protected $pdo = null;
    protected VariacaoDAO $variacaoDAO;
    protected VariacaoView $variacaoView;

    public function __construct()
    {
        $this->pdo = connect();
        $this->variacaoDAO = new VariacaoDAO($this->pdo);
        $this->variacaoView = new VariacaoView();
    }

    public function obterVariacaos()
    {
        $variacao = $this->variacaoDAO->obterVariacaos();
        $this->variacaoView->retornarEmJson($variacao);
    }

}
?>