<?php

require_once __DIR__ . '/../conn/conn.php';
require_once __DIR__ . '/../DAO/CategoriaDAO.php';
require_once __DIR__ . '/../view/CategoriaView.php';

class CategoriaController
{
    protected $pdo = null;
    protected CategoriaDAO $categoriaDAO;
    protected CategoriaView $categoriaView;

    public function __construct()
    {
        $this->pdo = connect();
        $this->categoriaDAO = new CategoriaDAO($this->pdo);
        $this->categoriaView = new CategoriaView();
    }

    public function obterCategorias()
    {
        $categoria = $this->categoriaDAO->obterCategorias();
        $this->categoriaView->retornarEmJson($categoria);
    }
}
?>