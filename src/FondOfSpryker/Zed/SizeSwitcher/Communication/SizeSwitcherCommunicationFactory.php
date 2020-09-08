<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Communication;

use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\SizeSwitcherDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherQueryContainerInterface getQueryContainer()
 */
class SizeSwitcherCommunicationFactory extends AbstractCommunicationFactory
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
}
