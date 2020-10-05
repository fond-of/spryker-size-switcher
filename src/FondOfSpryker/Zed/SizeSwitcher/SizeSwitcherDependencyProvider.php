<?php

namespace FondOfSpryker\Zed\SizeSwitcher;

use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeBridge;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeBridge;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeBridge;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SizeSwitcherDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';
    public const FACADE_PRODUCT_PAGE_SEARCH = 'FACADE_PRODUCT_PAGE_SEARCH';
    public const FACADE_STORE = 'FACADE_STORE';
    public const QUERY_AVAILABILITY_ABSTRACT = 'QUERY_AVAILABILITY_ABSTRACT';
    public const QUERY_AVAILABILITY = 'QUERY_AVAILABILITY';
    public const QUERY_PRODUCT_ABSTRACT = 'PRODUCT_ABSTRACT_QUERY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addFacadeEventBehavior($container);
        $container = $this->addStoreFacade($container);
        $container = $this->addFacadeProductPageSearch($container);
        $container = $this->addAvailabilityAbstractQuery($container);
        $container = $this->addProductAbstractQuery($container);
        $container = $this->addAvailabilityQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addAvailabilityAbstractQuery($container);
        $container = $this->addProductAbstractQuery($container);
        $container = $this->addAvailabilityQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityQuery(Container $container): Container
    {
        $container[static::QUERY_AVAILABILITY] = static function (Container $container) {
            return SpyAvailabilityQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityAbstractQuery(Container $container): Container
    {
        $container[static::QUERY_AVAILABILITY_ABSTRACT] = static function (Container $container) {
            return SpyAvailabilityAbstractQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractQuery(Container $container): Container
    {
        $container[static::QUERY_PRODUCT_ABSTRACT] = static function (Container $container) {
            return SpyProductAbstractQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeEventBehavior(Container $container): Container
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = static function (Container $container) {
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
        $container[static::FACADE_PRODUCT_PAGE_SEARCH] = static function (Container $container) {
            return new SizeSwitcherToProductPageSearchFacadeBridge($container->getLocator()->productPageSearch()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new SizeSwitcherToStoreFacadeBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }
}
