<?php

require_once __DIR__ . '/../conn/conn.php';
require_once __DIR__ . '/../DAO/EnderecoDAO.php';
require_once __DIR__ . '/../view/EnderecoView.php';

class EnderecoController
{
    protected $pdo = null;
    protected EnderecoDAO $enderecoDAO;
    protected EnderecoView $enderecoView;

    public function __construct()
    {
        $this->pdo = connect();
        $this->enderecoDAO = new EnderecoDAO($this->pdo);
        $this->enderecoView = new EnderecoView();
    }

    public function obterEnderecos()
    {
        $endereco = $this->enderecoDAO->obterEnderecos();
        $this->enderecoView->retornarEmJson($endereco);
    }
}
?>