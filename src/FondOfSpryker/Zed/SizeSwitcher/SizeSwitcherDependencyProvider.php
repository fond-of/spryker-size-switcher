<?php

namespace FondOfSpryker\Zed\SizeSwitcher;

use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeBridge;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SizeSwitcherDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    public const FACADE_PRODUCT_PAGE_SEARCH = 'FACADE_PRODUCT_PAGE_SEARCH';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addFacadeEventBehavior($container);
        $container = $this->addFacadeProductPageSearch($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeEventBehavior(Container $container): Container
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = function (Container $container) {
            return new SizeSwitcherToEventBehaviorFacadeBridge($container->getLocator()->eventBehavior()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeProductPageSearch(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_PAGE_SEARCH] = function (Container $container) {
            return new SizeSwitcherToProductPageSearchFacadeBridge($container->getLocator()->productPageSearch()->facade());
        };

        return $container;
    }
}
