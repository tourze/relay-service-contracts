<?php

namespace Tourze\RelayServiceContracts;

use ServerNodeBundle\Entity\Node;
use Tourze\GBT2659\Alpha2Code;

/**
 * 落地机
 */
interface LandingServerInterface
{
    /**
     * 落地服务类型
     */
    public function getServerType(): string;

    /**
     * 连接主机/IP
     */
    public function getConnectHost(): string;

    /**
     * 连接端口
     */
    public function getConnectPort(): int;

    /**
     * 一些通用的落地配置信息
     */
    public function getConnectParams(): ?array;

    /**
     * 落地服务所在地区
     */
    public function getLocation(): ?Alpha2Code;

    /**
     * 获取资源的唯一资源符号
     */
    public function getURI(): string;

    /**
     * 关联的服务器节点信息
     *
     * @return Node|null
     */
    public function getNode(): ?Node;
}
