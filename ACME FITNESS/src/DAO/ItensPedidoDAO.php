<?php

class ItensPedidoDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarItensPedido($item,$pedido_id)
    {

        $stmt = $this->pdo->prepare("INSERT INTO itens_pedido (pedido_id, variacao_id, preco_venda, quantidade) 
            VALUES (:pedido_id, :variacao_id, :preco_venda, :quantidade)");
        $stmt->execute([
            'pedido_id' => $pedido_id,
            'variacao_id' => $item->id,
            'preco_venda' => $item->produto->preco,
            'quantidade' => $item->quantidade_vendas
        ]);

    }
}
