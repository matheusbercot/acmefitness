<?php

require_once __DIR__ . '/Endereco.php';
require_once __DIR__ . '/Variacao.php';
require_once __DIR__ . '/Cliente.php';

class Pedido
{
    public $id;
    public array $variacoes;
    public $preco_venda;
    public $valor_frete;
    public $descontos;
    public $forma_pagamento;
    public $cliente_id;
    public $endereco_id;

    public function __construct(
        $id = null,
        $variacoes = [],
        $valor_frete = 10,
        $descontos=0,
        $forma_pagamento='',
        $cliente_id=0,
        $endereco_id=0
    ) {

       
        $this->id = $id;
        $this->variacoes = $variacoes;
        $this->endereco_id = $endereco_id;
        $this->cliente_id = $cliente_id;
        $this->valor_frete = $valor_frete;
        $this->descontos = $descontos;
        $this->forma_pagamento = $forma_pagamento;
        $this->preco_venda = $this->calcularValorTotal();
    
    }

    public function calcularValorTotal(): float
    {

        $total = 0;
        foreach ($this->variacoes as $item) {
            $total += $item;
        }        
        
        
        $desconto = $this->forma_pagamento == 'PIX' ? 0.1 : $this->descontos;
        $total_com_desconto = $total * (1 - $desconto);

     
        $valor_total = $total_com_desconto + $this->valor_frete;

       
        return $valor_total;
    }
}
