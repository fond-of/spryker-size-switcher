<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade;

use Spryker\Zed\ProductPageSearch\Business\ProductPageSearchFacadeInterface;

class SizeSwitcherToProductPageSearchFacadeBridge implements SizeSwitcherToProductPageSearchFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductPageSearch\Business\ProductPageSearchFacadeInterface
     */
    private $productPageSearchFacade;

    public function __construct(ProductPageSearchFacadeInterface $productPageSearchFacade)
    {
        $this->productPageSearchFacade = $productPageSearchFacade;
    }

    /**
     * @param int[] $productAbstractIds
     *
     * @return void
     */
    public function publish(array $productAbstractIds): void
    {
        $this->productPageSearchFacade->publish($productAbstractIds);
    }

    /**
     * @param int[] $productAbstractIds
     * @param string[] $pageDataExpanderPluginNames
     *
     * @return void
     */
    public function refresh(array $productAbstractIds, array $pageDataExpanderPluginNames = []): void
    {
        $this->productPageSearchFacade->refresh($productAbstractIds, $pageDataExpanderPluginNames);
    }
}
