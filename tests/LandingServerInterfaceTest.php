<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\RelayServiceContracts\LandingServerInterface;
use Tourze\RelayServiceContracts\NodeInterface;

/**
 * 落地服务器接口测试
 *
 * 验证接口约定和方法签名的正确性
 * @internal
 */
#[CoversClass(LandingServerInterface::class)]
final class LandingServerInterfaceTest extends TestCase
{
    /**
     * 测试接口方法是否存在
     */
    public function testInterfaceMethodsExist(): void
    {
        $reflection = new \ReflectionClass(LandingServerInterface::class);

        // 验证接口中所有必需的方法都存在
        $this->assertTrue($reflection->hasMethod('getServerType'));
        $this->assertTrue($reflection->hasMethod('getConnectHost'));
        $this->assertTrue($reflection->hasMethod('getConnectPort'));
        $this->assertTrue($reflection->hasMethod('getServerConnectParams'));
        $this->assertTrue($reflection->hasMethod('getLocation'));
        $this->assertTrue($reflection->hasMethod('getUri'));
        $this->assertTrue($reflection->hasMethod('getNode'));
    }

    /**
     * 测试方法返回类型
     */
    public function testMethodReturnTypes(): void
    {
        $reflection = new \ReflectionClass(LandingServerInterface::class);

        // 测试 getServerType 返回类型
        $getServerTypeMethod = $reflection->getMethod('getServerType');
        $serverTypeReturnType = $getServerTypeMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $serverTypeReturnType);
        $this->assertEquals('string', $serverTypeReturnType->getName());
        $this->assertFalse($serverTypeReturnType->allowsNull());

        // 测试 getConnectHost 返回类型
        $getConnectHostMethod = $reflection->getMethod('getConnectHost');
        $connectHostReturnType = $getConnectHostMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $connectHostReturnType);
        $this->assertEquals('string', $connectHostReturnType->getName());
        $this->assertFalse($connectHostReturnType->allowsNull());

        // 测试 getConnectPort 返回类型
        $getConnectPortMethod = $reflection->getMethod('getConnectPort');
        $connectPortReturnType = $getConnectPortMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $connectPortReturnType);
        $this->assertEquals('int', $connectPortReturnType->getName());
        $this->assertFalse($connectPortReturnType->allowsNull());

        // 测试 getServerConnectParams 返回类型（可空数组）
        $getServerConnectParamsMethod = $reflection->getMethod('getServerConnectParams');
        $paramsReturnType = $getServerConnectParamsMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $paramsReturnType);
        $this->assertEquals('array', $paramsReturnType->getName());
        $this->assertTrue($paramsReturnType->allowsNull());

        // 测试 getLocation 返回类型（可空）
        $getLocationMethod = $reflection->getMethod('getLocation');
        $locationReturnType = $getLocationMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $locationReturnType);
        $this->assertEquals('Tourze\GBT2659\Alpha2Code', $locationReturnType->getName());
        $this->assertTrue($locationReturnType->allowsNull());

        // 测试 getUri 返回类型
        $getUriMethod = $reflection->getMethod('getUri');
        $uriReturnType = $getUriMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $uriReturnType);
        $this->assertEquals('string', $uriReturnType->getName());
        $this->assertFalse($uriReturnType->allowsNull());

        // 测试 getNode 返回类型（可空）
        $getNodeMethod = $reflection->getMethod('getNode');
        $nodeReturnType = $getNodeMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $nodeReturnType);
        $this->assertEquals(NodeInterface::class, $nodeReturnType->getName());
        $this->assertTrue($nodeReturnType->allowsNull());
    }

    /**
     * 测试接口是否正确声明
     */
    public function testInterfaceDeclaration(): void
    {
        $reflection = new \ReflectionClass(LandingServerInterface::class);

        $this->assertTrue($reflection->isInterface());
        $this->assertEquals('Tourze\RelayServiceContracts', $reflection->getNamespaceName());
        $this->assertEquals('LandingServerInterface', $reflection->getShortName());
    }

    /**
     * 测试接口文档注释
     */
    public function testInterfaceDocumentation(): void
    {
        $reflection = new \ReflectionClass(LandingServerInterface::class);
        $docComment = $reflection->getDocComment();

        $this->assertNotFalse($docComment);
        $this->assertStringContainsString('落地服务器接口', $docComment);
        $this->assertStringContainsString('定义落地服务器的基本属性和连接信息', $docComment);
    }

    /**
     * 测试方法参数和返回类型符合约定
     */
    public function testMethodSignatures(): void
    {
        $reflection = new \ReflectionClass(LandingServerInterface::class);

        // getServerType 无参数
        $getServerTypeMethod = $reflection->getMethod('getServerType');
        $this->assertCount(0, $getServerTypeMethod->getParameters());

        // getConnectHost 无参数
        $getConnectHostMethod = $reflection->getMethod('getConnectHost');
        $this->assertCount(0, $getConnectHostMethod->getParameters());

        // getConnectPort 无参数
        $getConnectPortMethod = $reflection->getMethod('getConnectPort');
        $this->assertCount(0, $getConnectPortMethod->getParameters());

        // getServerConnectParams 无参数
        $getServerConnectParamsMethod = $reflection->getMethod('getServerConnectParams');
        $this->assertCount(0, $getServerConnectParamsMethod->getParameters());

        // getLocation 无参数
        $getLocationMethod = $reflection->getMethod('getLocation');
        $this->assertCount(0, $getLocationMethod->getParameters());

        // getUri 无参数
        $getUriMethod = $reflection->getMethod('getUri');
        $this->assertCount(0, $getUriMethod->getParameters());

        // getNode 无参数
        $getNodeMethod = $reflection->getMethod('getNode');
        $this->assertCount(0, $getNodeMethod->getParameters());
    }
}
