<?php

require_once __DIR__ . '/Produto.php';
class Variacao
{
    public $id;
    public $nome;
    public $quantidade_estoque;
    public Produto $produto;
    public $quantidade_vendas;

    public function __construct(
        $id,
        $nome = null,
        $quantidade_estoque = 0,
        Produto $produto  = null,
        $quantidade_vendas = 0

    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->quantidade_estoque = $quantidade_estoque;
        $this->produto = $produto;
        $this->quantidade_vendas = $quantidade_vendas;
    }
}
