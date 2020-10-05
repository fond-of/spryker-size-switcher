<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\SizeSwitcher\Business\SizeSwitcherBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface getRepository()
 */
class SizeSwitcherFacade extends AbstractFacade implements SizeSwitcherFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfer
     *
     * @return void
     */
    public function update(array $eventTransfer): void
    {
        $this->getFactory()
            ->createProductAbstractPageSearchPublisher()
            ->publish($eventTransfer);
    }
}
