<?php



class PedidoDAO
{

    protected $pdo = null;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarPedido($pedido) {


        $stmt = $this->pdo->prepare('INSERT INTO pedidos (cliente_id, endereco_id, valor_total, valor_frete, desconto, forma_pagamento) VALUES (:cliente_id, :endereco_id, :valor_total, :valor_frete, :desconto, :forma_pagamento)');
        $stmt->execute([
            'cliente_id' => $pedido->cliente_id,
            'endereco_id' => $pedido->endereco_id,
            'valor_total' => $pedido->preco_venda,
            'valor_frete' => $pedido->valor_frete,
            'desconto' => $pedido->descontos,
            'forma_pagamento' => $pedido->forma_pagamento
        ]);
        return $this->pdo->lastInsertId();
    }
}
