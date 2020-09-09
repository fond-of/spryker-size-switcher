<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade;

interface SizeSwitcherToProductPageSearchFacadeInterface
{
    /**
     * @param int[] $productAbstractIds
     */
    public function publish(array $productAbstractIds): void;

    /**
     * @param int[] $productAbstractIds
     * @param string[] $pageDataExpanderPluginNames
     *
     * @return void
     */
    public function refresh(array $productAbstractIds, array $pageDataExpanderPluginNames = []): void;
}
