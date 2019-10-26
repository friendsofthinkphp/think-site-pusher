<?php
namespace EasyPush;

use think\Service;
use EasyPush\Pusher;

class PusherService extends Service
{
    public function register()
    {
        $this->app->bind('pusher', Pusher::class);
    }
}
