<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;
use ServerNodeBundle\Entity\Node;
use Tourze\GBT2659\Alpha2Code;
use Tourze\RelayServiceContracts\LandingServerInterface;

class LandingServerInterfaceTest extends TestCase
{
    public function test_interface_exists(): void
    {
        $this->assertTrue(interface_exists(LandingServerInterface::class));
    }

    public function test_interface_has_correct_methods(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $methods = $reflection->getMethods();
        
        $expectedMethods = [
            'getServerType',
            'getConnectHost',
            'getConnectPort',
            'getConnectParams',
            'getLocation',
            'getURI',
            'getNode'
        ];
        $actualMethods = array_map(fn($method) => $method->getName(), $methods);
        
        foreach ($expectedMethods as $expectedMethod) {
            $this->assertContains($expectedMethod, $actualMethods);
        }
        
        $this->assertCount(7, $methods);
    }

    public function test_getServerType_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $method = $reflection->getMethod('getServerType');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertFalse($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('string', $returnType->getName());
    }

    public function test_getConnectHost_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $method = $reflection->getMethod('getConnectHost');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertFalse($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('string', $returnType->getName());
    }

    public function test_getConnectPort_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $method = $reflection->getMethod('getConnectPort');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertFalse($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('int', $returnType->getName());
    }

    public function test_getConnectParams_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $method = $reflection->getMethod('getConnectParams');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('array', $returnType->getName());
    }

    public function test_getLocation_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $method = $reflection->getMethod('getLocation');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals(Alpha2Code::class, $returnType->getName());
    }

    public function test_getURI_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $method = $reflection->getMethod('getURI');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertFalse($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('string', $returnType->getName());
    }

    public function test_getNode_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingServerInterface::class);
        $method = $reflection->getMethod('getNode');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals(Node::class, $returnType->getName());
    }
}