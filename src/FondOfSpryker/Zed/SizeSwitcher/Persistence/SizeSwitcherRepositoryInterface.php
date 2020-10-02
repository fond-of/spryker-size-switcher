<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

interface SizeSwitcherRepositoryInterface
{
    /**
     * @param string[] $productAbstractSkus
     *
     * @return int[]
     */
    public function queryProductAbstractIdsBySku(array $productAbstractSkus): array;

    /**
     * @param int[] $availabiltyIds
     * @param int $storeId
     *
     * @return int[]
     */
    public function queryProductAbstractSkuByAvailabilityIds(array $availabiltyIds, int $storeId): array;
}
