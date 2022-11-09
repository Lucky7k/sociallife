<?php

abstract class RouteSwitch
{
    protected function home()
    {
        require __DIR__ . '/View/index.php';
    }

    protected function login()
    {
        require __DIR__ . '/View/index.php';
    }

    protected function feed()
    {
        require __DIR__ . '/View/feed.php';
    }
    
    protected function perfil()
    {
        require __DIR__ . '/View/perfil.php';
    }
    
    protected function cadastro()
    {
        require __DIR__ . '/View/cadastro.php';
    }
    
    protected function usuarios()
    {
        require __DIR__ . '/View/usuarios.php';
    }
    
    protected function __call($name, $arguments)
    {
        http_response_code(404);
        require __DIR__ . '/View/not-found.html';
    }
}   