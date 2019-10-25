<?php

namespace EasyPush\Interfaces;

interface PushInterface
{
    public function setParams($method, $url);
    public function getQuery();
    public function getBody();
    public function getPath();
    public function getUri();
}
