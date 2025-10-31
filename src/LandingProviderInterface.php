<?php

namespace Tourze\RelayServiceContracts;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * 落地服务提供商接口
 *
 * 负责管理和提供落地服务器的访问
 */
interface LandingProviderInterface
{
    /**
     * 获取所有可用的落地服务器
     *
     * @return iterable<LandingServerInterface> 落地服务器集合
     */
    public function getLandingServers(): iterable;

    /**
     * 从URI中读取原始对象
     *
     * @param string $uri 资源标识符
     * @return LandingServerInterface|null 落地服务器实例，未找到时返回null
     */
    public function getLandingServerFromUri(string $uri): ?LandingServerInterface;

    /**
     * 获取完整的连接参数
     *
     * @param FrontendServerInterface $frontendServer 前端服务器
     * @param LandingServerInterface  $landingServer  落地机
     * @param UserInterface|null      $user           连接用户
     * @return array<string, mixed>|null 连接参数数组，失败时返回null
     */
    public function getConnectParams(FrontendServerInterface $frontendServer, LandingServerInterface $landingServer, ?UserInterface $user = null): ?array;
}
