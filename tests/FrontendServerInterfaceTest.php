<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
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
        $this->assertEquals('int', $returnType->getName());
    }

    public function test_mock_implementation_with_null_id(): void
    {
        /** @var FrontendServerInterface&MockObject $mock */
        $mock = $this->createMock(FrontendServerInterface::class);
        
        $mock->method('getId')->willReturn(null);
        $mock->method('getAccessHost')->willReturn('example.com');
        $mock->method('getBindPort')->willReturn(8080);
        
        $this->assertNull($mock->getId());
        $this->assertEquals('example.com', $mock->getAccessHost());
        $this->assertEquals(8080, $mock->getBindPort());
    }

    public function test_mock_implementation_with_string_id(): void
    {
        /** @var FrontendServerInterface&MockObject $mock */
        $mock = $this->createMock(FrontendServerInterface::class);
        
        $mock->method('getId')->willReturn('server-001');
        $mock->method('getAccessHost')->willReturn('proxy.example.com');
        $mock->method('getBindPort')->willReturn(443);
        
        $this->assertEquals('server-001', $mock->getId());
        $this->assertEquals('proxy.example.com', $mock->getAccessHost());
        $this->assertEquals(443, $mock->getBindPort());
    }

    public function test_mock_implementation_with_various_ports(): void
    {
        // 测试常见端口范围
        $testPorts = [80, 443, 8080, 3128, 1080, 65535];
        
        foreach ($testPorts as $port) {
            /** @var FrontendServerInterface&MockObject $mock */
            $mock = $this->createMock(FrontendServerInterface::class);
            $mock->method('getBindPort')->willReturn($port);
            $this->assertEquals($port, $mock->getBindPort());
        }
    }

    public function test_mock_implementation_with_various_hostnames(): void
    {
        $testHosts = [
            'localhost',
            '127.0.0.1',
            'example.com',
            'proxy-server.internal.company.com',
            'frontend-001.cdn.example.net'
        ];
        
        foreach ($testHosts as $host) {
            /** @var FrontendServerInterface&MockObject $mock */
            $mock = $this->createMock(FrontendServerInterface::class);
            $mock->method('getAccessHost')->willReturn($host);
            $this->assertEquals($host, $mock->getAccessHost());
        }
    }

    public function test_mock_implementation_edge_cases(): void
    {
        /** @var FrontendServerInterface&MockObject $mock */
        $mock = $this->createMock(FrontendServerInterface::class);
        
        // 测试边界情况
        $mock->method('getId')->willReturn('');
        $mock->method('getAccessHost')->willReturn('a');
        $mock->method('getBindPort')->willReturn(1);
        
        $this->assertEquals('', $mock->getId());
        $this->assertEquals('a', $mock->getAccessHost());
        $this->assertEquals(1, $mock->getBindPort());
    }
} 