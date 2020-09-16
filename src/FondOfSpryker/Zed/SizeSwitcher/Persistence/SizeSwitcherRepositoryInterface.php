<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

interface SizeSwitcherRepositoryInterface
{
    /**
     * @param int[] $availabiltyIds
     *
     * @return int[]
     */
    public function queryProductAbstractSkusByAvailabilityIds(array $availabiltyIds): array;

    /**
     * @param string[] $productAbstractSkus
     *
     * @return int[]
     */
    public function queryProductAbstractIdsBySku(array $productAbstractSkus): array;
}
