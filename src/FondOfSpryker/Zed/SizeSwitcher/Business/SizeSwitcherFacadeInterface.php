<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business;

interface SizeSwitcherFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfer
     *
     * @return void
     */
    public function update(array $eventTransfer): void;
}
