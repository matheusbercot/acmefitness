<?php
class Categoria
{
    public $id;
    public $codigo;
    public $nome;
    public $descricao;

    public function __construct(
        $id,
        $codigo = '',
        $nome = '',
        $descricao = '',

    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->descricao = $descricao;

    }
}
