<?php

namespace EasyPush;

use GuzzleHttp\Client;
use EasyPush\Exception\Exception;
use ReflectionClass;

class Pusher
{
    private $handle;

    private $client;

    public function __callStatic($name, $arguments)
    {
        $handle = "\\EasyPush\\Handles\\{$name}";

        if (false === class_exists($handle)) {
            throw new Exception("{$handle} Not Found!");
        }

        $reflectionClass = new ReflectionClass($handle);
        $interfaces      = $reflectionClass->getInterfaceNames();

        if (empty($interfaces) || !in_array('EasyPush\\Interfaces\\PushInterface', $interfaces)) {
            throw new Exception("{$handle} 没有继承相关接口类");
        }

        $instance = new static();
        $instance->handle = new $handle($arguments);
        $instance->client = new Client([
            'base_uri' => $instance->handle->getUri()
        ]);

        return $instance;
    }

    public function __call($method, $argc)
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

        } catch (\Excpetion $e) {
            
        }


        return $response->getBody()->getContents();
    }
}
