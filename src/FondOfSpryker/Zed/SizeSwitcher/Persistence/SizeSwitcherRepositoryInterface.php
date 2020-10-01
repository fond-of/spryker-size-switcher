<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Persistence;

interface SizeSwitcherRepositoryInterface
{
    /**
     * @param int[] $availabiltyIds
     *
     * @return int[]
     */
    public function queryProductAbstractSkusByAvailabilityAbstractIds(array $availabiltyIds, int $storeId): array;

    /**
     * @param int[] $availabiltyIds
     * @param int $storeId
     *
     * @return int[]
     */
    public function queryAbvailabiltyAbstractIdsByAvailabilityIds(array $availabiltyIds, int $storeId): array;

    /**
     * @param string[] $productAbstractSkus
     * @param int $storeId
     *
     * @return int[]
     */
    public function queryProductAbstractIdsBySku(array $productAbstractSkus): array;
}
