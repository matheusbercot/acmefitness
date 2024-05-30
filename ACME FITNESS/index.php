<?php
// index.php

// Carregar controlador de clientes
require 'src/controller/ClienteController.php';
require 'src/controller/ProdutoController.php';
require 'src/controller/CategoriaController.php';
require 'src/controller/VariacaoController.php';
require 'src/controller/EnderecoController.php';
require 'src/controller/PedidoController.php';

// Função simples de roteamento
function Rotas($method, $url, $data)
{
    switch ($url) {

        case '/clientes':
            $controller = new ClienteController();
            if ($method === 'GET') {
                $controller->obterClientes();
            }
            break;
        case '/produtos':
            $controller = new ProdutoController();
            if ($method === 'GET') {
                $controller->obterTodosProdutos();
            }
            break;
        case '/categorias':
            $controller = new CategoriaController();
            if ($method === 'GET') {
                $controller->obterCategorias();
            }
            break;
        case '/enderecos':
            $controller = new EnderecoController();
            if ($method === 'GET') {
                $controller->obterEnderecos();
            }
            break;
        case '/maisvendidos':
            $controller = new ProdutoController();
            if ($method === 'GET') {
                $controller->obterMaisVendidos();
            }
            break;
        case '/variacoes':
            $controller = new VariacaoController();
            if ($method === 'GET') {
                $controller->obterVariacaos();
            }

            case '/pedido':
                $controller = new PedidoController();
                if ($method === 'POST') {
                    $controller->cadastrarPedido($data);
                }

            break;


        default:
            http_response_code(404);
            echo json_encode(['message' => 'Rota não encontrada']);
            break;
    }
}

// Obter método, URL e dados da requisição
$method = $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$data = json_decode(file_get_contents('php://input'), true);

// Chamar roteador
Rotas($method, $url, $data);
