<?php

namespace EasyPush;

use GuzzleHttp\Client;
use EasyPush\Exception\Exception;
use EasyPush\Exception\ClassNotFound;
use EasyPush\Interfaces\PushInterface;
use ReflectionClass;

class Pusher
{
    private $handle;

    private $client;

    private $namespace = "\\EasyPush\\Handles\\";

    private $action = ['push', 'update', 'delete'];

    public function __call($name, $arguments)
    {
        if (!in_array($name, $this->action)) {
            return $this->setHandle($name, $arguments);
        }

        return $this->exec($name, $arguments);
    }

    private function setHandle($name, $arguments)
    {
        $className = $this->namespace . ucwords($name);

        if (false === class_exists($className)) {
            throw new ClassNotFound(
                sprintf('Class "%s" Not Found', $className)
            );
        }

        $reflectionClass = new ReflectionClass($className);
        $handle = $reflectionClass->newInstanceArgs($arguments);
        if (false === $handle instanceof PushInterface) {
            throw new Exception("{$className} is not instanceof PushInterface");
        }

        $instance = new static();
        $instance->handle = $handle;
        $instance->client = new Client([
            'base_uri' => $instance->handle->getUri()
        ]);

        return $instance;
    }

    private function exec($method, $argc)
    {
        $this->handle->setParams($method, $argc[0]);

        $body = $this->handle->getBody();
        $query = $this->handle->getQuery();
        $path = $this->handle->getPath();

        try {
            $response = $this->client->post($path, [
                'query' => $query,
                'body' => $body
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return ['code' => $e->getResponse()->getStatusCode(), 'result' => null];
        }

        return ['code' => 200, 'result' => $response->getBody()->getContents()];
    }
}
