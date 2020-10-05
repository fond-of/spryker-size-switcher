<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

use FondOfSpryker\Zed\SizeSwitcher\SizeSwitcherDependencyProvider;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface getRepository()
 */
class SizeSwitcherPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery
     */
    public function getAvailabilityQuery(): SpyAvailabilityQuery
    {
        return $this->getProvidedDependency(SizeSwitcherDependencyProvider::QUERY_AVAILABILITY);
    }

    /**
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery
     */
    public function getAvailabilityAbstractQuery(): SpyAvailabilityAbstractQuery
    {
        return $this->getProvidedDependency(SizeSwitcherDependencyProvider::QUERY_AVAILABILITY_ABSTRACT);
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function getProductAbstractQuery(): SpyProductAbstractQuery
    {
        return $this->getProvidedDependency(SizeSwitcherDependencyProvider::QUERY_PRODUCT_ABSTRACT);
    }
}
