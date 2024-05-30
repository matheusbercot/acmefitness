<?php

require_once __DIR__ . '..\..\DAO\PedidoDAO.php';
require_once __DIR__ . '..\..\DAO\ItensPedidoDAO.php';
require_once __DIR__ . '..\..\model\Pedido.php';
require_once __DIR__ . '..\..\model\Variacao.php';
require_once __DIR__ . '..\..\model\Categoria.php';

class PedidoService
{
    private $pedidoDAO;
    private $itensPedidoDAO;
    private $variacaoDAO;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->pedidoDAO = new PedidoDAO($pdo);
        $this->itensPedidoDAO = new ItensPedidoDAO($pdo);
        $this->variacaoDAO = new VariacaoDAO($pdo);
    }

    public function cadastrarPedido($data)
    {
        $this->pdo->beginTransaction();
        foreach ($data['variacoes_escolhidas'] as $item) {
            $variacoesData[] =  $this->variacaoDAO->obterPorId($item);
            $this->variacaoDAO->atualizarEstoque($item['id'], $item['quantidade']);
            $valor = $this->variacaoDAO->obterPrecoPorId($item['id']);
          $preco_venda[] = $valor['preco'] * $item['quantidade'];
    
        }

        $pedido = new Pedido(
            '',
            $preco_venda,
            $data['valor_frete'],
            $data['descontos'],
            $data['forma_pagamento'],
            $data['cliente_id'],
            $data['endereco_id']
        );
        $pedidoId = $this->pedidoDAO->cadastrarPedido($pedido);
        $pedido->id = $pedidoId;



        foreach ($variacoesData as $item) {
            $this->itensPedidoDAO->cadastrarItensPedido($item, $pedido->id);
        }
        $this->pdo->commit();
        return ['status' => 200, 'message' => 'Pedido cadastrado com sucesso'];
    }
}
