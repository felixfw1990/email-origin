email origin 
============

简介
---
清理邮件中的回复引用（origin）以及简单拼装引用。<br>
一般只适用于邮件自带回复。<br>
并不适用于自定义邮件内容。<br>
由于样本和邮件本身原因，有不稳定因素存在。

已实现邮件服务商
-------------
gmail outlook hotmail yahoo zoho <br>
icloud proton gmx aol yandex <br>
netease/163 tencent/qq sina <br>

运行测试用例
---------
```
composer install # 安装依赖
    
./vendor/phpunit/phpunit/phpunit test/Providers # 运行测试用例
```

使用
---
```php
// 清除
$html      = '<div>未过滤正文以及引用</div>';
$fromEmail = '****@gmail.com';

(new Email())->getContent($html, $fromEmail);


// 拼装 
$html      = '<div>正文</div>';
$orderHtml = '<div>引用</div>';
$fromEmail = '****@gmail.com';

(new Email())->setContent($html, $orderHtml, $fromEmail); 
```

