<?php
require_once(__DIR__ . "/../../configuracao.php");


function connect() {
    try {
        $pdo = new PDO("mysql:host=".HOST.";port=".PORTA.";dbname=".BANCO."", USUARIO, SENHA, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);  
        return $pdo;
    } catch (PDOException $e) {
        throw new PDOException('Não foi possível conectar ao Banco de dados: ' . $e->getMessage());
    }
}

?>