<?php

/**
 * File containing the VarnishProxyClientFactory class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\PlatformHttpCacheBundle\PurgeClient;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\DynamicSettingParserInterface;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use FOS\HttpCache\ProxyClient\HttpDispatcher;

/**
 * Factory for Varnish proxy client.
 */
class VarnishProxyClientFactory
{
    /**
     * @var ConfigResolverInterface
     */
    private $configResolver;

    /**
     * @var DynamicSettingParserInterface
     */
    private $dynamicSettingParser;

    /**
     * Configured class for Varnish proxy client service.
     *
     * @var string
     */
    private $proxyClientClass;

    public function __construct(
        ConfigResolverInterface $configResolver,
        DynamicSettingParserInterface $dynamicSettingParser,
        $proxyClientClass
    ) {
        $this->configResolver = $configResolver;
        $this->dynamicSettingParser = $dynamicSettingParser;
        $this->proxyClientClass = $proxyClientClass;
    }

    /**
     * Builds the proxy client, taking dynamically defined servers into account.
     *
     * @param HttpDispatcher $httpDispatcher
     *
     * @return \FOS\HttpCache\ProxyClient\Varnish
     */
    public function buildProxyClient(HttpDispatcher $httpDispatcher)
    {
        $class = $this->proxyClientClass;
        return new $class($httpDispatcher);
    }
}
