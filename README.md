# think-site-pusher
ThinkPHP 扩展包 网站链接提交  

[![Latest Stable Version](https://poser.pugx.org/xiaodi/think-site-pusher/v/stable)](https://packagist.org/packages/xiaodi/think-site-pusher)
[![Total Downloads](https://poser.pugx.org/xiaodi/think-site-pusher/downloads)](https://packagist.org/packages/xiaodi/think-site-pusher)
[![Latest Unstable Version](https://poser.pugx.org/xiaodi/think-site-pusher/v/unstable)](//packagist.org/packages/xiaodi/think-site-pusher)
## 安装
```
composer require xiaodi/think-site-pusher:dev-master
```

## 配置

#### 默认配置
项目根目录 `config/push.php`

#### 临时配置
```php
use EasyPush\Facade\Pusher;

$config = ['site' => 'xxx', 'token' => 'xxx'];
Pusher::baidu($config)->urls($urls);
```

## 使用
#### Facade
```php
use EasyPush\Facade\Pusher;

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

#### 助手函数
```php
$urls = [
  'https://www.xiaodim.com/index.html',
  'https://www.xiaodim.com/2019/10/25/thinkphp6-rpc-tutorial/'
]

// 推送链接
app('pusher')->baidu()->push($url);

// 更新链接
app('pusher')->baidu()->update($urls);

// 删除链接
app('pusher')->baidu()->delete($urls);
```
