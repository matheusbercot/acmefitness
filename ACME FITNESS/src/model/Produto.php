<?php
require_once __DIR__ . '/Categoria.php';

class Produto
{
    public $id;
    public $codigo;
    public $nome;
    public $cor;
    public $imagem;
    public $preco;
    public $descricao;
    public $data_de_cadastro;
    public $peso;
    public Categoria $categoria;
    
    public function __construct(
        $id,
        $codigo = '',
        $nome = '',
        $cor = '',
        $imagem = '',
        $preco = '',
        $descricao = '',
        $data_de_cadastro = '',
        $peso = '',
        Categoria $categoria = null
    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->cor = $cor;
        $this->imagem = $imagem;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->data_de_cadastro = $data_de_cadastro;
        $this->peso = $peso;
        $this->categoria = $categoria;
    }
}
