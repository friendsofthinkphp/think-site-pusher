<?php

namespace EasyPush\Handles;

use EasyPush\Interfaces\PushInterface;

class Baidu implements PushInterface
{
    const URI = 'http://data.zz.baidu.com';

    private $query = [];
    
    private $body = '';

    private $config = [
        'site' => '',
        'token' => ''
    ];

    public function __construct(array $config = [])
    {
        if (!empty($config)) {
            $this->config = array_merge($this->config, $config);
        } else {
            $this->config = array_merge($this->config, config('push'));
        }

        $this->setQuery($this->config['site'], $this->config['token']);
    }

    public function setParams($method, $url)
    {
        $this->path = "/{$method}";
        $this->setBody($url);
    }

    protected function setBody($url)
    {
        if (is_array($url)) {
            $this->body = implode("\n", $url);
        } else {
            $this->body = $url . "\n";
        }
    }

    public function getUri()
    {
        return self::URI;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getPath()
    {
        return $this->path;
    }

    protected function setQuery($site, $token)
    {
        $this->query = [
            'site' => $site,
            'token' => $token
        ];
    }
}
