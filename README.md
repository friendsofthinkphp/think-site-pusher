# think-site-pusher
ThinkPHP 扩展包 网站链接提交

## 安装
```
composer require xiaodi/think-site-pusher:dev-master
```

## 配置

### 默认配置
项目根目录 `config/push.php`

### 临时配置
```php
$config = ['site' => 'xxx', 'token' => 'xxx'];
Pusher::baidu($config)->urls($urls);
```

## 使用
```php
use EasyPush\Pusher;

$urls = [
  'https://www.xiaodim.com/index.html',
  'https://www.xiaodim.com/2019/10/25/thinkphp6-rpc-tutorial/'
]

// 推送链接
Pusher::baidu()->push($urls);

// 更新链接
Pusher::baidu()->update($urls);

// 删除链接
Pusher::baidu()->delete($urls);
```
