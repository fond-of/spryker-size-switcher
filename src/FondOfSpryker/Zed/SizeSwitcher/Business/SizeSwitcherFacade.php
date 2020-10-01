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
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return void
     */
    public function update(array $eventTransfer): void
    {
        $availabiltyIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($eventTransfer);

        if (empty($availabiltyIds)) {
            return;
        }

        $storeTransfer = $this->getFactory()
            ->getStoreFacade()
            ->getCurrentStore();

        $availabiltyAbstractIds = $this->getRepository()
            ->queryAbvailabiltyAbstractIdsByAvailabilityIds(
                $availabiltyIds,
                $storeTransfer->getIdStore()
            );

        if (empty($availabiltyAbstractIds)) {
            return;
        }

        $productAbstractSkus = $this->getRepository()
            ->queryProductAbstractSkusByAvailabilityAbstractIds(
                $availabiltyAbstractIds,
                $storeTransfer->getIdStore()
            );

        if (empty($productAbstractSkus)) {
            return;
        }

        $productAbstractIds = $this->getRepository()
            ->queryProductAbstractIdsBySku($productAbstractSkus);

        if (empty($productAbstractIds)) {
            return;
        }

        $this->getFactory()
            ->getProductPageSearchFacade()
            ->publish($productAbstractIds);
    }
}
