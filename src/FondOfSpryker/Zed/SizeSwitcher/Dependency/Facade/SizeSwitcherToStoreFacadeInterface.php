<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface SizeSwitcherToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
