<?php

class Router {
    private $endpoints = [];

    public function addEndpoint(string $method, string $uri, callable $callback) {
        $uri = '/^' . str_replace(['/', '{id}'], ['\/', '(\d+)'], $uri) . '$/';
        $this->endpoints[$method][$uri] = $callback;
    }

    public function route(string $method, string $uri) {
        if (!isset($this->endpoints[$method])) {
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
            exit;
        }

        foreach ($this->endpoints[$method] as $route => $callback) {
            if (preg_match($route, $uri, $matches)) {
                array_shift($matches);  // Remove the first element which is the whole matched text
                call_user_func_array($callback, $matches);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
        exit;
    }
}
