<?php

use EasyPush\Pusher;

// 兼容 5.1 版本
if (strpos(\think\App::VERSION, '5.1') !== false) {
    bind('pusher', Pusher::class);
}
