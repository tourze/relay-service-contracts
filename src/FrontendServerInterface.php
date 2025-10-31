<?php

namespace Tourze\RelayServiceContracts;

/**
 * 前端服务器接口
 *
 * 定义前端服务器的基本属性和访问方法
 */
interface FrontendServerInterface
{
    /**
     * 获取线路ID
     *
     * @return string|null 线路标识符，如果未设置则返回null
     */
    public function getId(): ?string;

    /**
     * 获取访问入口主机地址
     *
     * @return string 访问主机地址或域名
     */
    public function getAccessHost(): string;

    /**
     * 获取监听、绑定端口
     *
     * @return int 端口号，范围1-65535
     */
    public function getBindPort(): int;
}
