<?php

namespace EasyPush\Handles;

use EasyPush\Exception\InvalidArgumentException;
use EasyPush\Interfaces\PushInterface;

class Baidu implements PushInterface
{
    const URI = 'http://data.zz.baidu.com';

    private $actions = ['push' => '/urls', 'update' => 'update', 'delete' => '/del'];

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
            $this->config = array_merge($this->config, config('push.baidu'));
        }

        if (!$this->config['site'] || !$this->config['token']) {
            throw new InvalidArgumentException('site token配置不能为空');
        }

        $this->setQuery($this->config['site'], $this->config['token']);
    }

    public function setParams($method, $url)
    {
        if (!array_key_exists($method, $this->actions)) {
            throw new InvalidArgumentException(sprintf('"%s" not allow', $method));
        }

        $this->path = $this->actions[$method];
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
