<h1 align="center"> 依赖注入 </h1>

<p align="center"> 让你自定义的方法也可以使用依赖注入.</p>

## 文档

- [English document](https://github.com/iiDestiny/dependency-injection/blob/master/README.md)

## 要求

- PHP >= 7.0

## 安装

```bash
composer require iidestiny/dependency-injection -vvv
```

## 使用

使用辅助方法「推荐」

```php
    // 注册你的自定义类
    di_register(Tools::class)
    
    // 调用你类中的方法
    di_register(Tools::class)->generate($param, $param, $param)
    
    // 类所有方法都可以调用
    di_register(Tools::class)->foo($bar)
```

原本方法

```php
use Iidestiny\DependencyInjection\App;

App::register(Tools::class)
```

## 实例

例如有时候我们自定义的 Service 服务层可能也需要依赖注入其他工具类，但是我们控制器中已经依赖注入了 Service，调用 Service 中方法的时候就不能轻易的注入其他工具类，使用这个扩展包可以轻易解决这个问题，看下面例子。

```php
<?php

namespace App\Services;


use App\Tools;
use App\User;
use Cache;
use Petstore30\Order;

class OrderService
{
    /**
     * 下单
     *
     * @param User  $user
     * @param       $goods
     * @param       $address
     * @param Cache $cache
     * @param Tools $tools
     */
    public function placeOrder(User $user, $goods, $address, Cache $cache, Tools $tools)
    {
        // 下单逻辑，其中需要依赖注入 Cache 与 Tools
    }

    /**
     * pay
     *
     * @param Order $order
     * @param Cache $cache
     * @param Tools $tools
     */
    public function pay(Order $order, Cache $cache, Tools $tools)
    {
         // 支付逻辑，其中需要依赖注入 Cache 与 Tools
    }

}

```

我们可以轻易调用

```php
    /**
     * store
     */
    public function store()
    {
        di_register(OrderService::class)->placeOrder($user, $goods, $address);
    }
```

或者

```php
/**
     * store
     */
    public function store()
    {
        $orderService = di_register(OrderService::class);
        
        $orderService->placeOrder($user, $goods, $address);
        $orderService->pay($order);
    }
```

## License

MIT