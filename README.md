# relay-service-contracts

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/relay-service-contracts.svg?style=flat-square)](https://packagist.org/packages/tourze/relay-service-contracts)
[![Build Status](https://img.shields.io/github/actions/workflow/status/tourze/relay-service-contracts/tests.yml?branch=master&style=flat-square)](https://github.com/tourze/relay-service-contracts/actions)
[![Quality Score](https://img.shields.io/scrutinizer/g/tourze/relay-service-contracts.svg?style=flat-square)](https://scrutinizer-ci.com/g/tourze/relay-service-contracts)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/relay-service-contracts.svg?style=flat-square)](https://packagist.org/packages/tourze/relay-service-contracts)

A collection of interfaces for relay service implementations, providing contracts for frontend servers, landing providers, and landing servers.

## Features

- **Standardized Contracts**: Well-defined interfaces for relay service architecture
- **Frontend Server Management**: Interface for handling client connections and server binding
- **Landing Provider System**: Contract for managing landing servers and connection parameters
- **Landing Server Abstraction**: Interface for actual relay connection handling
- **Geographic Location Support**: Integration with country codes and server nodes
- **User Authentication**: Integration with Symfony Security UserInterface
- **Type Safety**: Full PHP 8.1+ type declarations and PHPStan level 5 compliance

## Installation

```bash
composer require tourze/relay-service-contracts
```

## Quick Start

```php
<?php

use Tourze\RelayServiceContracts\FrontendServerInterface;
use Tourze\RelayServiceContracts\LandingProviderInterface;
use Tourze\RelayServiceContracts\LandingServerInterface;

// Implement a frontend server
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

// Implement a landing server
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

## Interfaces

### FrontendServerInterface

Represents a frontend server that handles client connections:

```php
interface FrontendServerInterface
{
    public function getId(): ?string;
    public function getAccessHost(): string;
    public function getBindPort(): int;
}
```

### LandingProviderInterface

Manages landing servers and connection parameters:

```php
interface LandingProviderInterface
{
    public function getLandingServers(): iterable;
    public function getLandingServerFromURI(string $uri): ?LandingServerInterface;
    public function getConnectParams(
        FrontendServerInterface $frontendServer,
        LandingServerInterface $landingServer,
        ?UserInterface $user = null
    ): ?array;
}
```

### LandingServerInterface

Represents a landing server that handles relay connections:

```php
interface LandingServerInterface
{
    public function getServerType(): string;
    public function getConnectHost(): string;
    public function getConnectPort(): int;
    public function getConnectParams(): ?array;
    public function getLocation(): ?Alpha2Code;
    public function getURI(): string;
    public function getNode(): ?Node;
}
```

## Usage

Implement these interfaces in your relay service implementation:

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
    // Implement all required methods...
}

class MyLandingProvider implements LandingProviderInterface
{
    // Implement all required methods...
}
```

## Requirements

- PHP 8.1+
- Symfony Security Core 6.4+

## Dependencies

- `tourze/gb-t-2659`: For country code handling
- `tourze/server-node-bundle`: For server node entities

## Testing

Run the test suite:

```bash
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.