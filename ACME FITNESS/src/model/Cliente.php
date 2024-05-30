<?php
class Cliente
{

    public $id;
    public $cpf;
    public $nome;
    public $data_nascimento;

    public function __construct(
        $id,
        $cpf = '',
        $nome = '',
        $data_nascimento = ''
    ) {
        $this->id = $id;
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->data_nascimento = $data_nascimento;
    }
}
