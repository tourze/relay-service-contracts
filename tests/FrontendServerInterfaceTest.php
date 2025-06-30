<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;
use Tourze\RelayServiceContracts\FrontendServerInterface;

class FrontendServerInterfaceTest extends TestCase
{
    public function test_interface_exists(): void
    {
        $this->assertTrue(interface_exists(FrontendServerInterface::class));
    }

    public function test_interface_has_correct_methods(): void
    {
        $reflection = new ReflectionClass(FrontendServerInterface::class);
        $methods = $reflection->getMethods();
        
        $expectedMethods = ['getId', 'getAccessHost', 'getBindPort'];
        $actualMethods = array_map(fn($method) => $method->getName(), $methods);
        
        foreach ($expectedMethods as $expectedMethod) {
            $this->assertContains($expectedMethod, $actualMethods);
        }
        
        $this->assertCount(3, $methods);
    }

    public function test_getId_method_signature(): void
    {
        $reflection = new ReflectionClass(FrontendServerInterface::class);
        $method = $reflection->getMethod('getId');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('string', $returnType->getName());
    }

    public function test_getAccessHost_method_signature(): void
    {
        $reflection = new ReflectionClass(FrontendServerInterface::class);
        $method = $reflection->getMethod('getAccessHost');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertFalse($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('string', $returnType->getName());
    }

    public function test_getBindPort_method_signature(): void
    {
        $reflection = new ReflectionClass(FrontendServerInterface::class);
        $method = $reflection->getMethod('getBindPort');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(0, $method->getNumberOfParameters());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertFalse($returnType->allowsNull());
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertEquals('int', $returnType->getName());
    }

} 