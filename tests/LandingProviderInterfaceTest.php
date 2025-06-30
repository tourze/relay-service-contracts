<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;
use Symfony\Component\Security\Core\User\UserInterface;
use Tourze\RelayServiceContracts\FrontendServerInterface;
use Tourze\RelayServiceContracts\LandingProviderInterface;
use Tourze\RelayServiceContracts\LandingServerInterface;

class LandingProviderInterfaceTest extends TestCase
{
    public function test_interface_exists(): void
    {
        $this->assertTrue(interface_exists(LandingProviderInterface::class));
    }

    public function test_interface_has_correct_methods(): void
    {
        $reflection = new ReflectionClass(LandingProviderInterface::class);
        $methods = $reflection->getMethods();
        
        $expectedMethods = [
            'getLandingServers',
            'getLandingServerFromURI',
            'getConnectParams'
        ];
        $actualMethods = array_map(fn($method) => $method->getName(), $methods);
        
        foreach ($expectedMethods as $expectedMethod) {
            $this->assertContains($expectedMethod, $actualMethods);
        }
        
        $this->assertCount(3, $methods);
    }

    public function test_getLandingServers_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingProviderInterface::class);
        $method = $reflection->getMethod('getLandingServers');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertFalse($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('iterable', $returnType->getName());
    }

    public function test_getLandingServerFromURI_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingProviderInterface::class);
        $method = $reflection->getMethod('getLandingServerFromURI');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(1, $method->getNumberOfParameters());
        
        $parameters = $method->getParameters();
        $uriParameter = $parameters[0];
        $this->assertEquals('uri', $uriParameter->getName());
        $this->assertFalse($uriParameter->allowsNull());
        
        $paramType = $uriParameter->getType();
        $this->assertNotNull($paramType);
        $this->assertInstanceOf(ReflectionNamedType::class, $paramType);
        $this->assertEquals('string', $paramType->getName());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals(LandingServerInterface::class, $returnType->getName());
    }

    public function test_getConnectParams_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingProviderInterface::class);
        $method = $reflection->getMethod('getConnectParams');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(3, $method->getNumberOfParameters());
        
        $parameters = $method->getParameters();
        
        // 第一个参数：frontendServer
        $frontendParameter = $parameters[0];
        $this->assertEquals('frontendServer', $frontendParameter->getName());
        $this->assertFalse($frontendParameter->allowsNull());
        $frontendParamType = $frontendParameter->getType();
        $this->assertNotNull($frontendParamType);
        $this->assertInstanceOf(ReflectionNamedType::class, $frontendParamType);
        $this->assertEquals(FrontendServerInterface::class, $frontendParamType->getName());
        
        // 第二个参数：landingServer
        $landingParameter = $parameters[1];
        $this->assertEquals('landingServer', $landingParameter->getName());
        $this->assertFalse($landingParameter->allowsNull());
        $landingParamType = $landingParameter->getType();
        $this->assertNotNull($landingParamType);
        $this->assertInstanceOf(ReflectionNamedType::class, $landingParamType);
        $this->assertEquals(LandingServerInterface::class, $landingParamType->getName());
        
        // 第三个参数：user（可选）
        $userParameter = $parameters[2];
        $this->assertEquals('user', $userParameter->getName());
        $this->assertTrue($userParameter->allowsNull());
        $this->assertTrue($userParameter->isDefaultValueAvailable());
        $this->assertNull($userParameter->getDefaultValue());
        $userParamType = $userParameter->getType();
        $this->assertNotNull($userParamType);
        $this->assertInstanceOf(ReflectionNamedType::class, $userParamType);
        $this->assertEquals(UserInterface::class, $userParamType->getName());
        
        // 返回类型
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
    }
}