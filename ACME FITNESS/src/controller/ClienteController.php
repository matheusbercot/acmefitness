<?php

require_once __DIR__ . '/../conn/conn.php';
require_once __DIR__ . '/../DAO/ClienteDAO.php';
require_once __DIR__ . '/../view/ClienteView.php';

class ClienteController
{
    protected $pdo = null;
    protected ClienteDAO $clienteDAO;
    protected ClienteView $clienteView;

    public function __construct()
    {
        $this->pdo = connect();
        $this->clienteDAO = new ClienteDAO($this->pdo);
        $this->clienteView = new ClienteView();
    }

    public function obterClientes()
    {
        $cliente = $this->clienteDAO->obterClientes();
        $this->clienteView->retornarEmJson($cliente);
    }
}
?>