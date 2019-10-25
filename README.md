# think-site-pusher
ThinkPHP 扩展包 网站链接提交

## 安装
```
composer require xiaodi/think-site-pusher:dev-master
```

## 使用
```php
use xiaodi\EasyPush\Pusher;

$urls = [
  'https://www.xiaodim.com/index.html',
  'https://www.xiaodim.com/2019/10/25/thinkphp6-rpc-tutorial/'
]

// 推送链接
Pusher::baidu()->urls($urls);

// 更新链接
Pusher::baidu()->urls($urls);

// 删除链接
Pusher::baidu()->urls($urls);
```
