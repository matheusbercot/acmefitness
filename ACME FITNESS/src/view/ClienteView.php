<?php
class ClienteView
{
    function retornarEmJson($content)
    {
        header('Content-Type: application/json');
        echo json_encode($content);
    }
}
