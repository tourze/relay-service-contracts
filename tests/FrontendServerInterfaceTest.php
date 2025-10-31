<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\RelayServiceContracts\FrontendServerInterface;

/**
 * 前端服务器接口测试
 *
 * 验证接口约定和方法签名的正确性
 * @internal
 */
#[CoversClass(FrontendServerInterface::class)]
final class FrontendServerInterfaceTest extends TestCase
{
    /**
     * 测试接口方法是否存在
     */
    public function testInterfaceMethodsExist(): void
    {
        $reflection = new \ReflectionClass(FrontendServerInterface::class);

        // 验证接口中所有必需的方法都存在
        $this->assertTrue($reflection->hasMethod('getId'));
        $this->assertTrue($reflection->hasMethod('getAccessHost'));
        $this->assertTrue($reflection->hasMethod('getBindPort'));
    }

    /**
     * 测试方法返回类型
     */
    public function testMethodReturnTypes(): void
    {
        $reflection = new \ReflectionClass(FrontendServerInterface::class);

        // 测试 getId 返回类型（可空字符串）
        $getIdMethod = $reflection->getMethod('getId');
        $idReturnType = $getIdMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $idReturnType);
        $this->assertTrue($idReturnType->allowsNull());
        $this->assertEquals('string', $idReturnType->getName());

        // 测试 getAccessHost 返回类型
        $getAccessHostMethod = $reflection->getMethod('getAccessHost');
        $accessHostReturnType = $getAccessHostMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $accessHostReturnType);
        $this->assertEquals('string', $accessHostReturnType->getName());
        $this->assertFalse($accessHostReturnType->allowsNull());

        // 测试 getBindPort 返回类型
        $getBindPortMethod = $reflection->getMethod('getBindPort');
        $bindPortReturnType = $getBindPortMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $bindPortReturnType);
        $this->assertEquals('int', $bindPortReturnType->getName());
        $this->assertFalse($bindPortReturnType->allowsNull());
    }

    /**
     * 测试接口是否正确声明
     */
    public function testInterfaceDeclaration(): void
    {
        $reflection = new \ReflectionClass(FrontendServerInterface::class);

        $this->assertTrue($reflection->isInterface());
        $this->assertEquals('Tourze\RelayServiceContracts', $reflection->getNamespaceName());
        $this->assertEquals('FrontendServerInterface', $reflection->getShortName());
    }

    /**
     * 测试接口文档注释
     */
    public function testInterfaceDocumentation(): void
    {
        $reflection = new \ReflectionClass(FrontendServerInterface::class);
        $docComment = $reflection->getDocComment();

        $this->assertNotFalse($docComment);
        $this->assertStringContainsString('前端服务器接口', $docComment);
        $this->assertStringContainsString('定义前端服务器的基本属性和访问方法', $docComment);
    }

    /**
     * 测试方法参数和返回类型符合约定
     */
    public function testMethodSignatures(): void
    {
        $reflection = new \ReflectionClass(FrontendServerInterface::class);

        // getId 无参数
        $getIdMethod = $reflection->getMethod('getId');
        $this->assertCount(0, $getIdMethod->getParameters());

        // getAccessHost 无参数
        $getAccessHostMethod = $reflection->getMethod('getAccessHost');
        $this->assertCount(0, $getAccessHostMethod->getParameters());

        // getBindPort 无参数
        $getBindPortMethod = $reflection->getMethod('getBindPort');
        $this->assertCount(0, $getBindPortMethod->getParameters());
    }

    /**
     * 测试方法的文档注释包含预期信息
     */
    public function testMethodDocumentation(): void
    {
        $reflection = new \ReflectionClass(FrontendServerInterface::class);

        // 测试 getId 方法文档
        $getIdMethod = $reflection->getMethod('getId');
        $getIdDoc = $getIdMethod->getDocComment();
        $this->assertNotFalse($getIdDoc);
        $this->assertStringContainsString('获取线路ID', $getIdDoc);

        // 测试 getAccessHost 方法文档
        $getAccessHostMethod = $reflection->getMethod('getAccessHost');
        $getAccessHostDoc = $getAccessHostMethod->getDocComment();
        $this->assertNotFalse($getAccessHostDoc);
        $this->assertStringContainsString('获取访问入口主机地址', $getAccessHostDoc);

        // 测试 getBindPort 方法文档
        $getBindPortMethod = $reflection->getMethod('getBindPort');
        $getBindPortDoc = $getBindPortMethod->getDocComment();
        $this->assertNotFalse($getBindPortDoc);
        $this->assertStringContainsString('获取监听、绑定端口', $getBindPortDoc);
    }
}
