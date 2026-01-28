<?php

namespace App\Http;

use Exception;

class Response
{
    private $statusCode;
    private $headers;
    private $body;
    private $contentType;
    private $charset;

    public function __construct()
    {
        $this->statusCode = 200;
        $this->headers = [];
        $this->body = '';
        $this->contentType = 'text/html';
        $this->charset = 'UTF-8';
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    // Méthode de récupération

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeader($name)
    {
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    // Méthodes spécialisées

    public function redirect($url, $statusCode = 302)
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Location', $url);
        return $this;
    }

    public function view($templatePath, $data = [], $statusCode = 200)
    {
        $this->setStatusCode($statusCode);
        $fullPath = __DIR__ . '/../../templates/' . $templatePath;
        if (!file_exists($fullPath)) {
            throw new Exception("Template file not found: $fullPath");
        }
        ob_start();
        extract($data);
        include $fullPath;
        $content = ob_get_clean();
        $this->setBody($content);
        return $this;
    }

    public function error($message, $statusCode = 500)
    {
        $this->setStatusCode($statusCode);
        $this->setContentType('application/json');
        $this->setBody(json_encode([
            'error' => true,
            'message' => $message,
            'status_code' => $statusCode
        ]));
        return $this;
    }

    public function success($message, $statusCode = 200)
    {
        $this->setStatusCode($statusCode);
        $this->setContentType('application/json');
        $this->setBody(json_encode([
            'success' => true,
            'message' => $message,
            'status_code' => $statusCode
        ]));
        return $this;
    }

    public function send()
    {
        if (!headers_sent()) {
            http_response_code($this->statusCode);
            foreach ($this->headers as $name => $value) {
                header("$name: $value");
            }
            header("Content-Type: $this->contentType; charset=$this->charset");
        }
        echo $this->body;
        exit();
    }

    public function redirectTo($url, $statusCode = 302)
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Location', $url);
        $this->send();
    }

    public function errorResponse($message, $statusCode = 500)
    {
        $this->setStatusCode($statusCode);
        $this->setContentType('application/json');
        $this->setBody(json_encode([
            'error' => true,
            'message' => $message,
            'status_code' => $statusCode
        ]));
        $this->send();
    }
}
