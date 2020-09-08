<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherQueryContainerInterface getQueryContainer()
 */
class SizeSwitcherPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery
     */
    public function createSpyAvailabilityAbstractQuery(): SpyAvailabilityAbstractQuery
    {
        return SpyAvailabilityAbstractQuery::create();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function createSpyProductAbstractQuery()
    {
        return SpyProductAbstractQuery::create();
    }
}
