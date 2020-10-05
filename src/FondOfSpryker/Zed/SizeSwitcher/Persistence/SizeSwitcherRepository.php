<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityAbstractTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Propel\Runtime\Collection\ArrayCollection;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherPersistenceFactory getFactory()
 */
class SizeSwitcherRepository extends AbstractRepository implements SizeSwitcherRepositoryInterface
{
    /**
     * @param string[] $productAbstractSkus
     *
     * @return int[]
     */
    public function queryProductAbstractIdsBySku(array $productAbstractSkus): array
    {
        $result = $this->getFactory()
            ->getProductAbstractQuery()
            ->clear()
            ->select(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)
            ->filterBySku_In($productAbstractSkus)
            ->find();

        if (!$result instanceof ArrayCollection) {
            return [];
        }

        return $result->getData();
    }

    /**
     * @param int[] $availabiltyIds
     * @param int $storeId
     *
     * @return string[]
     */
    public function queryProductAbstractSkuByAvailabilityIds(array $availabiltyIds, int $storeId): array
    {
        $result = $this->getFactory()
            ->getAvailabilityQuery()
            ->select(SpyAvailabilityAbstractTableMap::COL_ABSTRACT_SKU)
            ->leftJoinWithSpyAvailabilityAbstract()
            ->filterByIdAvailability_In($availabiltyIds)
            ->filterByFkStore($storeId)
            ->find();

        if (!$result instanceof ArrayCollection) {
            return [];
        }

        return $result->getData();
    }
}
