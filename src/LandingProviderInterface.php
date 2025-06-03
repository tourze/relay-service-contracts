<?php

namespace Tourze\RelayServiceContracts;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * 获取落地服务
 */
interface LandingProviderInterface
{
    /**
     * @return iterable<LandingServerInterface>
     */
    public function getLandingServers(): iterable;

    /**
     * 从URI中读取原始对象
     */
    public function getLandingServerFromURI(string $uri): ?LandingServerInterface;

    /**
     * 获取完整的连接参数
     *
     * @param FrontendServerInterface $frontendServer 前端服务器
     * @param LandingServerInterface $landingServer 落地机
     * @param UserInterface|null $user 连接用户
     * @return array|null
     */
    public function getConnectParams(FrontendServerInterface $frontendServer, LandingServerInterface $landingServer, ?UserInterface $user = null): array|null;
}
