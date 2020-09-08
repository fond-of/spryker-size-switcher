<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityAbstractTableMap;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherPersistenceFactory getFactory()
 */
class SizeSwitcherQueryContainer extends AbstractQueryContainer implements SizeSwitcherQueryContainerInterface
{
    /**
     * @param int[] $availabiltyIds
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery
     */
    public function queryProductAbstractSkusByAvailabilityIds(array $availabiltyIds): SpyAvailabilityAbstractQuery
    {
        return $this->getFactory()
            ->createSpyAvailabilityAbstractQuery()
            ->select(SpyAvailabilityAbstractTableMap::COL_ABSTRACT_SKU)
            ->filterByIdAvailabilityAbstract_In($availabiltyIds);
    }

    /**
     * @param string[] $skus
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstractIdsBySku(array $skus): SpyProductAbstractQuery
    {
        return $this->getFactory()
            ->createSpyProductAbstractQuery()
            ->select(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)
            ->filterBySku_In($skus);
    }
}
