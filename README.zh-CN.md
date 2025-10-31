# relay-service-contracts

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/relay-service-contracts.svg?style=flat-square)](https://packagist.org/packages/tourze/relay-service-contracts)
[![Quality Score](https://img.shields.io/scrutinizer/g/tourze/relay-service-contracts.svg?style=flat-square)](https://scrutinizer-ci.com/g/tourze/relay-service-contracts)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/relay-service-contracts.svg?style=flat-square)](https://packagist.org/packages/tourze/relay-service-contracts)

中继服务契约接口集合，为前端服务器、落地提供者和落地服务器的实现提供契约定义。

## 功能特性

- **标准化契约**: 为中继服务架构定义良好的接口
- **前端服务器管理**: 处理客户端连接和服务器绑定的接口
- **落地提供者系统**: 管理落地服务器和连接参数的契约
- **落地服务器抽象**: 处理实际中继连接的接口
- **地理位置支持**: 集成国家代码和服务器节点
- **用户认证**: 集成 Symfony Security UserInterface
- **类型安全**: 完整的 PHP 8.1+ 类型声明和 PHPStan level 5 兼容性

## 安装

```bash
composer require tourze/relay-service-contracts
```

## 快速开始

```php
<?php

use Tourze\RelayServiceContracts\FrontendServerInterface;
use Tourze\RelayServiceContracts\LandingProviderInterface;
use Tourze\RelayServiceContracts\LandingServerInterface;

// 实现前端服务器
class MyFrontendServer implements FrontendServerInterface
{
    public function getId(): ?string
    {
        return 'frontend-1';
    }

    public function getAccessHost(): string
    {
        return 'relay.example.com';
    }

    public function getBindPort(): int
    {
        return 8080;
    }
}

// 实现落地服务器
class MyLandingServer implements LandingServerInterface
{
    public function getServerType(): string
    {
        return 'http';
    }

    public function getConnectHost(): string
    {
        return '10.0.0.1';
    }

    public function getConnectPort(): int
    {
        return 3128;
    }

    public function getConnectParams(): ?array
    {
        return ['timeout' => 30];
    }

    public function getLocation(): ?Alpha2Code
    {
        return Alpha2Code::US;
    }

    public function getURI(): string
    {
        return 'http://10.0.0.1:3128';
    }

    public function getNode(): ?Node
    {
        return null;
    }
}
```

## 接口定义

### FrontendServerInterface

表示处理客户端连接的前端服务器：

```php
interface FrontendServerInterface
{
    public function getId(): ?string;        // 线路ID
    public function getAccessHost(): string; // 访问入口
    public function getBindPort(): int;      // 监听、绑定端口
}
```

### LandingProviderInterface

管理落地服务器和连接参数：

```php
interface LandingProviderInterface
{
    // 获取所有落地服务器
    public function getLandingServers(): iterable;
    
    // 从URI中读取原始对象
    public function getLandingServerFromURI(string $uri): ?LandingServerInterface;
    
    // 获取完整的连接参数
    public function getConnectParams(
        FrontendServerInterface $frontendServer,
        LandingServerInterface $landingServer,
        ?UserInterface $user = null
    ): ?array;
}
```

### LandingServerInterface

表示处理中继连接的落地服务器：

```php
interface LandingServerInterface
{
    public function getServerType(): string;     // 落地服务类型
    public function getConnectHost(): string;    // 连接主机/IP
    public function getConnectPort(): int;       // 连接端口
    public function getConnectParams(): ?array;  // 通用的落地配置信息
    public function getLocation(): ?Alpha2Code;  // 落地服务所在地区
    public function getURI(): string;            // 资源的唯一资源符号
    public function getNode(): ?Node;            // 关联的服务器节点信息
}
```

## 使用方法

在你的中继服务实现中实现这些接口：

```php
use Tourze\RelayServiceContracts\FrontendServerInterface;
use Tourze\RelayServiceContracts\LandingProviderInterface;
use Tourze\RelayServiceContracts\LandingServerInterface;

class MyFrontendServer implements FrontendServerInterface
{
    public function getId(): ?string
    {
        return 'frontend-1';
    }

    public function getAccessHost(): string
    {
        return 'relay.example.com';
    }

    public function getBindPort(): int
    {
        return 8080;
    }
}

class MyLandingServer implements LandingServerInterface
{
    // 实现所有必需的方法...
}

class MyLandingProvider implements LandingProviderInterface
{
    // 实现所有必需的方法...
}
```

## 系统要求

- PHP 8.1+
- Symfony Security Core 6.4+

## 依赖项

- `tourze/gb-t-2659`: 用于国家代码处理
- `tourze/server-node-bundle`: 用于服务器节点实体

## 测试

运行测试套件：

```bash
vendor/bin/phpunit
```

## 贡献

请参阅 [CONTRIBUTING.md](CONTRIBUTING.md) 了解详情。

## 许可证

MIT 许可证。详见 [LICENSE](LICENSE) 文件。
