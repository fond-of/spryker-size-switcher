<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityAbstractTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherPersistenceFactory getFactory()
 */
class SizeSwitcherRepository extends AbstractRepository implements SizeSwitcherRepositoryInterface
{
    /**
     * @param int[] $availabiltyIds
     *
     * @return int[]
     */
    public function queryProductAbstractSkusByAvailabilityIds(array $availabiltyIds): array
    {
        return $this->getFactory()
            ->getAvailabilityAbstractQuery()
            ->select(SpyAvailabilityAbstractTableMap::COL_ABSTRACT_SKU)
            ->filterByIdAvailabilityAbstract_In($availabiltyIds)
            ->find()
            ->getData();
    }

    /**
     * @param string[] $productAbstractSkus
     *
     * @return int[]
     */
    public function queryProductAbstractIdsBySku(array $productAbstractSkus): array
    {
        return $this->getFactory()
            ->getProductAbstractQuery()
            ->select(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)
            ->filterBySku_In($productAbstractSkus)
            ->find()
            ->getData();
    }
}
