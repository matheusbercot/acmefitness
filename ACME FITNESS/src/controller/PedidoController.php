<?php

require_once __DIR__ . '..\..\service\PedidoService.php';
require_once __DIR__ . '..\..\View\PedidoView.php';


class PedidoController
{

    protected $pdo = null;
    private $pedidoService = null;
    private $pedidoView = null;

    public function __construct()
    {
        $this->pdo = connect();
        $this->pedidoService = new PedidoService($this->pdo);
        $this->pedidoView = new PedidoView();
    }

    public function cadastrarPedido($request)
    {
        $pedido = $this->pedidoService->cadastrarPedido($request);
        $this->pedidoView->retornarEmJson($pedido);
    }
}
