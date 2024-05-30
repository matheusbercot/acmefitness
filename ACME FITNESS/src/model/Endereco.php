<?php
class Endereco
{
    public $id;
    public $codigo;
    public $logradouro;
    public $cidade;
    public $bairro;
    public $numero;
    public $cep;
    public $complemento;

    public function __construct(
        $id,
        $codigo = '',
        $logradouro = '',
        $cidade = '',
        $bairro = '',
        $numero = '',
        $cep = '',
        $complemento = ''
    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->logradouro = $logradouro;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cep = $cep;
        $this->complemento = $complemento;
    }
}
