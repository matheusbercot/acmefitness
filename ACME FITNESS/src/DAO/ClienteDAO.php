<?php

require_once __DIR__ . '..\..\model\Cliente.php';

class ClienteDAO
{

    protected $pdo = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obterPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute(["id" => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $clientes = $this->transformarEmCliente($resultado);
        return $clientes;
    }

    public function obterClientes()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM clientes');
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $clientes = [];

        foreach ($resultados as $resultado) {
            $clientes[] = $this->transformarEmCliente($resultado);;
        }

        return $clientes;
    }

    function transformarEmCliente($resultado)
    {
        $cliente = new Cliente(
            $resultado['id'],
            $resultado['cpf'],
            $resultado['nome'],
            $resultado['data_nascimento']
        );

        return $cliente;
    }
}
