<?php

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;

class Router{
    private array $routes ;
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response){
        $this->routes = [];
        $this->request = $request;
        $this->response = $response;
    }

    public function addRoute($action, $fonction, $methodes = ['GET']){
        $this->routes[$action] = [
            'fonction' => $fonction,
            'methodes' => $methodes
        ];
        return $this;
    }

    public function handleRequest(){
        $method = $this->request->getMethod();
        $action = $this->request->getAction();

        if (!isset($this->routes[$action])) {
            $this->handleNotFound();
            return;
        }
        $route = $this->routes[$action];
        if (!in_array($method, $route['methodes'])) {
            // utilise la méthode dédiée
            $this->handleMethodNotAllowed($route['methodes']);
            return;
        }
        if (!function_exists($route['fonction'])) {
            $this->handleNotFound();
            return;
        }
        call_user_func($route['fonction'], $this->request, $this->response);
        $this->response->send();
    }

    private function handleNotFound(){
        $this->response->redirect("index.php?action=index");
        $this->response->send();
    }

    private function handleMethodNotAllowed($methodesAutorisees){
        $allow = is_array($methodesAutorisees) ? implode(', ', $methodesAutorisees) : (string)$methodesAutorisees;
        $this->response->setHeader('Allow', $allow);
        $this->response->error('Méthode non autorisée pour cette action. Méthodes autorisées : ' . $allow, 405);
        $this->response->send();
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function hasRoute($action){
        return isset($this->routes[$action]);
    }
}