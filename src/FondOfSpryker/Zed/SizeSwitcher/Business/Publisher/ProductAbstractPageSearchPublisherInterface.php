<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business\Publisher;

interface ProductAbstractPageSearchPublisherInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfer
     *
     * @return void
     */
    public function publish(array $eventTransfer): void;
}
