<?php

require_once __DIR__ . '..\..\model\Endereco.php';

class EnderecoDAO
{

    protected $pdo = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obterPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM endereco WHERE id = :id");
        $stmt->execute(["id" => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $endereco = $this->transformarEmEndereco($resultado);
        return $endereco;
    }

    public function obterEnderecos()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM enderecos');
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $enderecos = [];

        foreach ($resultados as $resultado) {
            $enderecos[] = $this->transformarEmEndereco($resultado);
        }

        return $enderecos;
    }

    function transformarEmEndereco($resultado)
    {
        $endereco = new Endereco(
            $resultado['id'],
            $resultado['codigo'],
            $resultado['logradouro'],
            $resultado['cidade'],
            $resultado['bairro'],
            $resultado['numero'],
            $resultado['cep'],
            $resultado['complemento'],
        );

        return $endereco;
    }
}
