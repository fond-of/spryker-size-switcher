<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface SizeSwitcherQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @param int[] $availabiltyIds
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery
     */
    public function queryProductAbstractSkusByAvailabilityIds(array $availabiltyIds): SpyAvailabilityAbstractQuery;

    /**
     * @param string[] $skus
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstractIdsBySku(array $skus): SpyProductAbstractQuery;
}
