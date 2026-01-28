<?php

namespace App\Http;

class Request
{
    private array $get ;
    private array $post;
    private array $server;
    
    private string $method;
    private string $action;

    public function __construct()
    {
        $this->get = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->server = $_SERVER ?? [];

        // Défaut sûr si REQUEST_METHOD absent (ex: exécution CLI)
        $this->method = $this->server['REQUEST_METHOD'] ?? 'GET';
        $this->action = $this->get['action'] ?? 'index';
    }

    // Méthodes de récupération de paramètres

    public function get(string $key, $default = null)
    {
        return $this->get[$key] ?? $default; 
    }

    public function post(string $key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function allPost()
    {
        return $this->post;
    }

    public function allGet()
    {
        return $this->get;
    }

    // Méthodes de vérification du type de requête

    public function isPost(): bool
    {
        return $this->method === "POST";
    }

    public function isGet(): bool
    {
        return $this->method === "GET";
    }

    // Méthodes d'information sur la requête

    public function getMethod()
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->get) || array_key_exists($key, $this->post);
    }

    public function getUrl()
    {
        $host = $this->server['HTTP_HOST'] ?? $this->server['SERVER_NAME'] ?? 'localhost';
        $uri = $this->server['REQUEST_URI'] ?? $this->server['PHP_SELF'] ?? '/';
        $scheme = (!empty($this->server['HTTPS']) && $this->server['HTTPS'] !== 'off') ? 'https' : 'http';
        return $scheme . '://' . $host . $uri;
    }

    public function getClientIp()
    {
        return $this->server['REMOTE_ADDR'] ?? $this->server['SERVER_ADDR'] ?? '127.0.0.1';
    }
}