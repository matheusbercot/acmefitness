<?php

require_once __DIR__ . '..\..\model\Categoria.php';

class CategoriaDAO
{

    protected $pdo = null;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obterPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categorias WHERE id = :id");
        $stmt->execute(["id" => $id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $categoria = $this->transformarEmCategoria($resultado);
        return $categoria;
    }

    public function obterCategorias()
    {
        
        $stmt = $this->pdo->prepare('SELECT * FROM categorias');
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categorias = [];

        foreach ($resultados as $resultado) {
            $categorias[] = $this->transformarEmCategoria($resultado);
        }

        return $categorias;
    }


    function transformarEmCategoria($resultado)
    {
        $categoria = new Categoria(
            $resultado['id'],
            $resultado['codigo'],
            $resultado['nome'],
            $resultado['descricao']
        );


        return $categoria;
    }
}
