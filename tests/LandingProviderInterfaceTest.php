<?php

namespace Tourze\RelayServiceContracts\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
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
        $this->assertEquals('uri', $parameters[0]->getName());
        $this->assertEquals('string', $parameters[0]->getType()->getName());
        $this->assertFalse($parameters[0]->allowsNull());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertEquals('Tourze\RelayServiceContracts\LandingServerInterface', $returnType->getName());
    }

    public function test_getConnectParams_method_signature(): void
    {
        $reflection = new ReflectionClass(LandingProviderInterface::class);
        $method = $reflection->getMethod('getConnectParams');
        
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isStatic());
        $this->assertEquals(3, $method->getNumberOfParameters());
        
        $parameters = $method->getParameters();
        
        // 第一个参数: FrontendServerInterface $frontendServer
        $this->assertEquals('frontendServer', $parameters[0]->getName());
        $this->assertEquals('Tourze\RelayServiceContracts\FrontendServerInterface', $parameters[0]->getType()->getName());
        $this->assertFalse($parameters[0]->allowsNull());
        
        // 第二个参数: LandingServerInterface $landingServer
        $this->assertEquals('landingServer', $parameters[1]->getName());
        $this->assertEquals('Tourze\RelayServiceContracts\LandingServerInterface', $parameters[1]->getType()->getName());
        $this->assertFalse($parameters[1]->allowsNull());
        
        // 第三个参数: ?UserInterface $user (可选)
        $this->assertEquals('user', $parameters[2]->getName());
        $this->assertEquals('Symfony\Component\Security\Core\User\UserInterface', $parameters[2]->getType()->getName());
        $this->assertTrue($parameters[2]->allowsNull());
        $this->assertTrue($parameters[2]->isDefaultValueAvailable());
        $this->assertNull($parameters[2]->getDefaultValue());
        
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertEquals('array', $returnType->getName());
    }

    public function test_mock_implementation_getLandingServers_with_array(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        /** @var LandingServerInterface&MockObject $server1 */
        $server1 = $this->createMock(LandingServerInterface::class);
        
        /** @var LandingServerInterface&MockObject $server2 */
        $server2 = $this->createMock(LandingServerInterface::class);
        
        $servers = [$server1, $server2];
        
        $mock->method('getLandingServers')->willReturn($servers);
        
        $result = $mock->getLandingServers();
        $this->assertIsIterable($result);
        $this->assertCount(2, $result);
        $this->assertSame($server1, $result[0]);
        $this->assertSame($server2, $result[1]);
    }

    public function test_mock_implementation_getLandingServers_with_generator(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        /** @var LandingServerInterface&MockObject $server */
        $server = $this->createMock(LandingServerInterface::class);
        
        $generator = (function() use ($server) {
            yield $server;
        })();
        
        $mock->method('getLandingServers')->willReturn($generator);
        
        $result = $mock->getLandingServers();
        $this->assertIsIterable($result);
        
        $servers = iterator_to_array($result);
        $this->assertCount(1, $servers);
        $this->assertSame($server, $servers[0]);
    }

    public function test_mock_implementation_getLandingServers_empty(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        $mock->method('getLandingServers')->willReturn([]);
        
        $result = $mock->getLandingServers();
        $this->assertIsIterable($result);
        $this->assertCount(0, $result);
    }

    public function test_mock_implementation_getLandingServerFromURI_found(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        /** @var LandingServerInterface&MockObject $server */
        $server = $this->createMock(LandingServerInterface::class);
        
        $mock->method('getLandingServerFromURI')
             ->with('ss://example-server-uri')
             ->willReturn($server);
        
        $result = $mock->getLandingServerFromURI('ss://example-server-uri');
        $this->assertSame($server, $result);
        $this->assertInstanceOf(LandingServerInterface::class, $result);
    }

    public function test_mock_implementation_getLandingServerFromURI_not_found(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        $mock->method('getLandingServerFromURI')
             ->with('invalid://uri')
             ->willReturn(null);
        
        $result = $mock->getLandingServerFromURI('invalid://uri');
        $this->assertNull($result);
    }

    public function test_mock_implementation_getLandingServerFromURI_various_schemes(): void
    {
        $testURIs = [
            'ss://server1',
            'vmess://server2',
            'trojan://server3',
            'http://server4',
            'socks5://server5'
        ];
        
        foreach ($testURIs as $uri) {
            /** @var LandingProviderInterface&MockObject $mock */
            $mock = $this->createMock(LandingProviderInterface::class);
            
            /** @var LandingServerInterface&MockObject $server */
            $server = $this->createMock(LandingServerInterface::class);
            
            $mock->method('getLandingServerFromURI')
                 ->with($uri)
                 ->willReturn($server);
            
            $result = $mock->getLandingServerFromURI($uri);
            $this->assertSame($server, $result);
        }
    }

    public function test_mock_implementation_getConnectParams_with_user(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        /** @var FrontendServerInterface&MockObject $frontendServer */
        $frontendServer = $this->createMock(FrontendServerInterface::class);
        
        /** @var LandingServerInterface&MockObject $landingServer */
        $landingServer = $this->createMock(LandingServerInterface::class);
        
        /** @var UserInterface&MockObject $user */
        $user = $this->createMock(UserInterface::class);
        
        $expectedParams = [
            'frontend_host' => 'frontend.example.com',
            'frontend_port' => 8080,
            'landing_host' => 'landing.example.com',
            'landing_port' => 8388,
            'user_id' => 'user123'
        ];
        
        $mock->method('getConnectParams')
             ->with($frontendServer, $landingServer, $user)
             ->willReturn($expectedParams);
        
        $result = $mock->getConnectParams($frontendServer, $landingServer, $user);
        $this->assertEquals($expectedParams, $result);
    }

    public function test_mock_implementation_getConnectParams_without_user(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        /** @var FrontendServerInterface&MockObject $frontendServer */
        $frontendServer = $this->createMock(FrontendServerInterface::class);
        
        /** @var LandingServerInterface&MockObject $landingServer */
        $landingServer = $this->createMock(LandingServerInterface::class);
        
        $expectedParams = [
            'frontend_host' => 'frontend.example.com',
            'frontend_port' => 8080,
            'landing_host' => 'landing.example.com',
            'landing_port' => 8388
        ];
        
        $mock->method('getConnectParams')
             ->with($frontendServer, $landingServer, null)
             ->willReturn($expectedParams);
        
        $result = $mock->getConnectParams($frontendServer, $landingServer);
        $this->assertEquals($expectedParams, $result);
    }

    public function test_mock_implementation_getConnectParams_returns_null(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        /** @var FrontendServerInterface&MockObject $frontendServer */
        $frontendServer = $this->createMock(FrontendServerInterface::class);
        
        /** @var LandingServerInterface&MockObject $landingServer */
        $landingServer = $this->createMock(LandingServerInterface::class);
        
        $mock->method('getConnectParams')
             ->with($frontendServer, $landingServer, null)
             ->willReturn(null);
        
        $result = $mock->getConnectParams($frontendServer, $landingServer);
        $this->assertNull($result);
    }

    public function test_mock_implementation_getConnectParams_empty_array(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        /** @var FrontendServerInterface&MockObject $frontendServer */
        $frontendServer = $this->createMock(FrontendServerInterface::class);
        
        /** @var LandingServerInterface&MockObject $landingServer */
        $landingServer = $this->createMock(LandingServerInterface::class);
        
        $mock->method('getConnectParams')
             ->with($frontendServer, $landingServer, null)
             ->willReturn([]);
        
        $result = $mock->getConnectParams($frontendServer, $landingServer);
        $this->assertEquals([], $result);
    }

    public function test_mock_implementation_complex_workflow(): void
    {
        /** @var LandingProviderInterface&MockObject $mock */
        $mock = $this->createMock(LandingProviderInterface::class);
        
        // 准备 mock 对象
        /** @var LandingServerInterface&MockObject $server1 */
        $server1 = $this->createMock(LandingServerInterface::class);
        $server1->method('getURI')->willReturn('ss://server1');
        
        /** @var LandingServerInterface&MockObject $server2 */
        $server2 = $this->createMock(LandingServerInterface::class);
        $server2->method('getURI')->willReturn('vmess://server2');
        
        /** @var FrontendServerInterface&MockObject $frontendServer */
        $frontendServer = $this->createMock(FrontendServerInterface::class);
        
        /** @var UserInterface&MockObject $user */
        $user = $this->createMock(UserInterface::class);
        
        // 配置 mock 行为
        $mock->method('getLandingServers')->willReturn([$server1, $server2]);
        $mock->method('getLandingServerFromURI')
             ->willReturnMap([
                 ['ss://server1', $server1],
                 ['vmess://server2', $server2],
                 ['invalid://uri', null]
             ]);
        
        $mock->method('getConnectParams')
             ->with($frontendServer, $server1, $user)
             ->willReturn(['type' => 'shadowsocks', 'user_authenticated' => true]);
        
        // 测试工作流
        $servers = $mock->getLandingServers();
        $this->assertCount(2, $servers);
        
        $foundServer = $mock->getLandingServerFromURI('ss://server1');
        $this->assertSame($server1, $foundServer);
        
        $notFoundServer = $mock->getLandingServerFromURI('invalid://uri');
        $this->assertNull($notFoundServer);
        
        $connectParams = $mock->getConnectParams($frontendServer, $server1, $user);
        $this->assertEquals(['type' => 'shadowsocks', 'user_authenticated' => true], $connectParams);
    }
} 