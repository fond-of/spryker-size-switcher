<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business;

use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\SizeSwitcherDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface getRepository()
 */
class SizeSwitcherBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): SizeSwitcherToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(SizeSwitcherDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface
     */
    public function getProductPageSearchFacade(): SizeSwitcherToProductPageSearchFacadeInterface
    {
        return $this->getProvidedDependency(SizeSwitcherDependencyProvider::FACADE_PRODUCT_PAGE_SEARCH);
    }

    /**
     * @return \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface
     */
    public function getStoreFacade(): SizeSwitcherToStoreFacadeInterface
    {
        return $this->getProvidedDependency(SizeSwitcherDependencyProvider::FACADE_STORE);
    }
}
