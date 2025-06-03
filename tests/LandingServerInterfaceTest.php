<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
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
        $this->assertEquals('Tourze\GBT2659\Alpha2Code', $returnType->getName());
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
        $this->assertEquals('ServerNodeBundle\Entity\Node', $returnType->getName());
    }

    public function test_mock_implementation_basic(): void
    {
        /** @var LandingServerInterface&MockObject $mock */
        $mock = $this->createMock(LandingServerInterface::class);
        
        $mock->method('getServerType')->willReturn('shadowsocks');
        $mock->method('getConnectHost')->willReturn('landing.example.com');
        $mock->method('getConnectPort')->willReturn(8388);
        $mock->method('getConnectParams')->willReturn(['method' => 'aes-256-gcm']);
        $mock->method('getLocation')->willReturn(Alpha2Code::US);
        $mock->method('getURI')->willReturn('ss://example-uri');
        $mock->method('getNode')->willReturn(null);
        
        $this->assertEquals('shadowsocks', $mock->getServerType());
        $this->assertEquals('landing.example.com', $mock->getConnectHost());
        $this->assertEquals(8388, $mock->getConnectPort());
        $this->assertEquals(['method' => 'aes-256-gcm'], $mock->getConnectParams());
        $this->assertEquals(Alpha2Code::US, $mock->getLocation());
        $this->assertEquals('ss://example-uri', $mock->getURI());
        $this->assertNull($mock->getNode());
    }

    public function test_mock_implementation_with_null_values(): void
    {
        /** @var LandingServerInterface&MockObject $mock */
        $mock = $this->createMock(LandingServerInterface::class);
        
        $mock->method('getServerType')->willReturn('vmess');
        $mock->method('getConnectHost')->willReturn('127.0.0.1');
        $mock->method('getConnectPort')->willReturn(1080);
        $mock->method('getConnectParams')->willReturn(null);
        $mock->method('getLocation')->willReturn(null);
        $mock->method('getURI')->willReturn('vmess://localhost-test');
        $mock->method('getNode')->willReturn(null);
        
        $this->assertEquals('vmess', $mock->getServerType());
        $this->assertEquals('127.0.0.1', $mock->getConnectHost());
        $this->assertEquals(1080, $mock->getConnectPort());
        $this->assertNull($mock->getConnectParams());
        $this->assertNull($mock->getLocation());
        $this->assertEquals('vmess://localhost-test', $mock->getURI());
        $this->assertNull($mock->getNode());
    }

    public function test_mock_implementation_with_various_server_types(): void
    {
        $serverTypes = ['shadowsocks', 'vmess', 'trojan', 'vless', 'http', 'socks5'];
        
        foreach ($serverTypes as $serverType) {
            /** @var LandingServerInterface&MockObject $mock */
            $mock = $this->createMock(LandingServerInterface::class);
            $mock->method('getServerType')->willReturn($serverType);
            $this->assertEquals($serverType, $mock->getServerType());
        }
    }

    public function test_mock_implementation_with_various_locations(): void
    {
        $locations = [Alpha2Code::US, Alpha2Code::CN, Alpha2Code::JP, Alpha2Code::GB, Alpha2Code::DE];
        
        foreach ($locations as $location) {
            /** @var LandingServerInterface&MockObject $mock */
            $mock = $this->createMock(LandingServerInterface::class);
            $mock->method('getLocation')->willReturn($location);
            $this->assertEquals($location, $mock->getLocation());
        }
    }

    public function test_mock_implementation_with_complex_params(): void
    {
        /** @var LandingServerInterface&MockObject $mock */
        $mock = $this->createMock(LandingServerInterface::class);
        
        $complexParams = [
            'method' => 'aes-256-gcm',
            'password' => 'secret-password',
            'plugin' => 'v2ray-plugin',
            'plugin_opts' => 'server;tls;host=example.com',
            'remarks' => 'Test Server',
            'group' => 'Premium'
        ];
        
        $mock->method('getConnectParams')->willReturn($complexParams);
        $this->assertEquals($complexParams, $mock->getConnectParams());
    }

    public function test_mock_implementation_with_node(): void
    {
        /** @var LandingServerInterface&MockObject $mock */
        $mock = $this->createMock(LandingServerInterface::class);
        
        /** @var Node&MockObject $nodeMock */
        $nodeMock = $this->createMock(Node::class);
        
        $mock->method('getNode')->willReturn($nodeMock);
        $this->assertSame($nodeMock, $mock->getNode());
        $this->assertInstanceOf(Node::class, $mock->getNode());
    }

    public function test_mock_implementation_edge_cases(): void
    {
        /** @var LandingServerInterface&MockObject $mock */
        $mock = $this->createMock(LandingServerInterface::class);
        
        // 测试边界情况
        $mock->method('getServerType')->willReturn('');
        $mock->method('getConnectHost')->willReturn('0.0.0.0');
        $mock->method('getConnectPort')->willReturn(1);
        $mock->method('getConnectParams')->willReturn([]);
        $mock->method('getURI')->willReturn('://');
        
        $this->assertEquals('', $mock->getServerType());
        $this->assertEquals('0.0.0.0', $mock->getConnectHost());
        $this->assertEquals(1, $mock->getConnectPort());
        $this->assertEquals([], $mock->getConnectParams());
        $this->assertEquals('://', $mock->getURI());
    }

    public function test_mock_implementation_high_port_numbers(): void
    {
        $highPorts = [65535, 65534, 32768, 49152];
        
        foreach ($highPorts as $port) {
            /** @var LandingServerInterface&MockObject $mock */
            $mock = $this->createMock(LandingServerInterface::class);
            $mock->method('getConnectPort')->willReturn($port);
            $this->assertEquals($port, $mock->getConnectPort());
        }
    }
} 