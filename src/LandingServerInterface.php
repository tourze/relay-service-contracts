<?php

namespace Tourze\RelayServiceContracts;

use ServerNodeBundle\Entity\Node;
use Tourze\GBT2659\Alpha2Code;

/**
 * 落地服务器接口
 *
 * 定义落地服务器的基本属性和连接信息
 */
interface LandingServerInterface
{
    /**
     * 获取落地服务类型标识
     *
     * @return string 服务类型（如：http, socks5, vmess等）
     */
    public function getServerType(): string;

    /**
     * 获取连接主机地址
     *
     * @return string 主机地址或IP
     */
    public function getConnectHost(): string;

    /**
     * 获取连接端口
     *
     * @return int 端口号，范围1-65535
     */
    public function getConnectPort(): int;

    /**
     * 一些通用的落地配置信息
     *
     * @return array<string, mixed>|null 配置参数数组，无配置时返回null
     */
    public function getServerConnectParams(): ?array;

    /**
     * 获取落地服务所在地区代码
     *
     * @return Alpha2Code|null 国家/地区代码，未知时返回null
     */
    public function getLocation(): ?Alpha2Code;

    /**
     * 获取资源的唯一资源符号
     *
     * @return string 唯一资源URI
     */
    public function getUri(): string;

    /**
     * 获取关联的服务器节点信息
     *
     * @return Node|null 节点实体，无关联时返回null
     */
    public function getNode(): ?Node;
}
