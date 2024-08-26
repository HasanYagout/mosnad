<?php

namespace Core;
use Core\Middleware\Guest;


class Router
{
    protected $routes=[];

    public function add($uri,$controller,$method)
    {
        $this->routes[]=[
            'uri'=>$uri,
            'controller'=>$controller,
            'method'=>$method,
            'middleware'=>null
        ];

        return $this;
    }
    public function get($uri,$controller)
    {
       return $this->add($uri,$controller,'GET');
    }

    public function post($uri,$controller)
    {
       return $this->add($uri,$controller,'POST');
    }

    public function delete($uri,$controller)
    {
       return $this->add($uri,$controller,'delete');

    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function patch()
    {
        
    }

    public function put()
    {
        
    }

    public function route($uri,$method)
    {

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                if ($route['middleware'] == 'guest') {

                    (new Guest)->handle();
                }
                if ($route['middleware'] == 'auth') {

                    (new Guest)->handle();
                }
                return require base_path($route['controller']);
            }
        }
        $this->abort();
    }
    protected function abort($code=404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}





