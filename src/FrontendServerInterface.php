<?php

namespace Tourze\RelayServiceContracts;

interface FrontendServerInterface
{
    /**
     * 线路ID
     */
    public function getId(): ?string;

    /**
     * 访问入口
     */
    public function getAccessHost(): string;

    /**
     * 监听、绑定端口
     */
    public function getBindPort(): int;
}
