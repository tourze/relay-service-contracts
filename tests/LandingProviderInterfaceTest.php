<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;
use Tourze\RelayServiceContracts\FrontendServerInterface;
use Tourze\RelayServiceContracts\LandingProviderInterface;
use Tourze\RelayServiceContracts\LandingServerInterface;

/**
 * 落地服务提供商接口测试
 *
 * 验证接口约定和方法签名的正确性
 * @internal
 */
#[CoversClass(LandingProviderInterface::class)]
final class LandingProviderInterfaceTest extends TestCase
{
    /**
     * 测试接口方法是否存在
     */
    public function testInterfaceMethodsExist(): void
    {
        $reflection = new \ReflectionClass(LandingProviderInterface::class);

        // 验证接口中所有必需的方法都存在
        $this->assertTrue($reflection->hasMethod('getLandingServers'));
        $this->assertTrue($reflection->hasMethod('getLandingServerFromUri'));
        $this->assertTrue($reflection->hasMethod('getConnectParams'));
    }

    /**
     * 测试方法返回类型
     */
    public function testMethodReturnTypes(): void
    {
        $reflection = new \ReflectionClass(LandingProviderInterface::class);

        // 测试 getLandingServers 返回类型（iterable）
        $getLandingServersMethod = $reflection->getMethod('getLandingServers');
        $serversReturnType = $getLandingServersMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $serversReturnType);
        $this->assertEquals('iterable', $serversReturnType->getName());
        $this->assertFalse($serversReturnType->allowsNull());

        // 测试 getLandingServerFromUri 返回类型（可空）
        $getLandingServerFromUriMethod = $reflection->getMethod('getLandingServerFromUri');
        $uriReturnType = $getLandingServerFromUriMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $uriReturnType);
        $this->assertEquals(LandingServerInterface::class, $uriReturnType->getName());
        $this->assertTrue($uriReturnType->allowsNull());

        // 测试 getConnectParams 返回类型（可空数组）
        $getConnectParamsMethod = $reflection->getMethod('getConnectParams');
        $paramsReturnType = $getConnectParamsMethod->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $paramsReturnType);
        $this->assertEquals('array', $paramsReturnType->getName());
        $this->assertTrue($paramsReturnType->allowsNull());
    }

    /**
     * 测试接口是否正确声明
     */
    public function testInterfaceDeclaration(): void
    {
        $reflection = new \ReflectionClass(LandingProviderInterface::class);

        $this->assertTrue($reflection->isInterface());
        $this->assertEquals('Tourze\RelayServiceContracts', $reflection->getNamespaceName());
        $this->assertEquals('LandingProviderInterface', $reflection->getShortName());
    }

    /**
     * 测试接口文档注释
     */
    public function testInterfaceDocumentation(): void
    {
        $reflection = new \ReflectionClass(LandingProviderInterface::class);
        $docComment = $reflection->getDocComment();

        $this->assertNotFalse($docComment);
        $this->assertStringContainsString('落地服务提供商接口', $docComment);
        $this->assertStringContainsString('负责管理和提供落地服务器的访问', $docComment);
    }

    /**
     * 测试方法参数签名
     */
    public function testMethodSignatures(): void
    {
        $reflection = new \ReflectionClass(LandingProviderInterface::class);

        // getLandingServers 无参数
        $getLandingServersMethod = $reflection->getMethod('getLandingServers');
        $this->assertCount(0, $getLandingServersMethod->getParameters());

        // getLandingServerFromUri 有一个字符串参数
        $getLandingServerFromUriMethod = $reflection->getMethod('getLandingServerFromUri');
        $uriParams = $getLandingServerFromUriMethod->getParameters();
        $this->assertCount(1, $uriParams);
        $this->assertEquals('uri', $uriParams[0]->getName());
        $this->assertEquals('string', (string) $uriParams[0]->getType());

        // getConnectParams 有三个参数
        $getConnectParamsMethod = $reflection->getMethod('getConnectParams');
        $connectParams = $getConnectParamsMethod->getParameters();
        $this->assertCount(3, $connectParams);

        // 第一个参数：FrontendServerInterface
        $this->assertEquals('frontendServer', $connectParams[0]->getName());
        $this->assertEquals(FrontendServerInterface::class, (string) $connectParams[0]->getType());

        // 第二个参数：LandingServerInterface
        $this->assertEquals('landingServer', $connectParams[1]->getName());
        $this->assertEquals(LandingServerInterface::class, (string) $connectParams[1]->getType());

        // 第三个参数：可空的UserInterface
        $this->assertEquals('user', $connectParams[2]->getName());
        $this->assertTrue($connectParams[2]->hasType());
        $this->assertTrue($connectParams[2]->allowsNull());
        $this->assertTrue($connectParams[2]->isDefaultValueAvailable());
        $this->assertNull($connectParams[2]->getDefaultValue());
    }

    /**
     * 测试方法的文档注释包含预期信息
     */
    public function testMethodDocumentation(): void
    {
        $reflection = new \ReflectionClass(LandingProviderInterface::class);

        // 测试 getLandingServers 方法文档
        $getLandingServersMethod = $reflection->getMethod('getLandingServers');
        $getLandingServersDoc = $getLandingServersMethod->getDocComment();
        $this->assertNotFalse($getLandingServersDoc);
        $this->assertStringContainsString('获取所有可用的落地服务器', $getLandingServersDoc);

        // 测试 getLandingServerFromUri 方法文档
        $getLandingServerFromUriMethod = $reflection->getMethod('getLandingServerFromUri');
        $getFromUriDoc = $getLandingServerFromUriMethod->getDocComment();
        $this->assertNotFalse($getFromUriDoc);
        $this->assertStringContainsString('从URI中读取原始对象', $getFromUriDoc);

        // 测试 getConnectParams 方法文档
        $getConnectParamsMethod = $reflection->getMethod('getConnectParams');
        $getConnectParamsDoc = $getConnectParamsMethod->getDocComment();
        $this->assertNotFalse($getConnectParamsDoc);
        $this->assertStringContainsString('获取完整的连接参数', $getConnectParamsDoc);
    }

    /**
     * 测试接口的使用声明（imports）
     */
    public function testImportedClasses(): void
    {
        $reflection = new \ReflectionClass(LandingProviderInterface::class);

        // 验证接口能够正确引用相关类型
        $getConnectParamsMethod = $reflection->getMethod('getConnectParams');
        $parameters = $getConnectParamsMethod->getParameters();

        // 验证能够正确引用FrontendServerInterface
        $frontendParam = $parameters[0];
        $this->assertEquals(FrontendServerInterface::class, (string) $frontendParam->getType());

        // 验证能够正确引用LandingServerInterface
        $landingParam = $parameters[1];
        $this->assertEquals(LandingServerInterface::class, (string) $landingParam->getType());
    }
}
