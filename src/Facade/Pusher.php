<?php

namespace EasyPush\Facade;

use think\Facade;
use EasyPush\Pusher as Accessor;

class Pusher extends Facade
{
    protected static function getFacadeClass()
    {
        return Accessor::class;
    }
}
