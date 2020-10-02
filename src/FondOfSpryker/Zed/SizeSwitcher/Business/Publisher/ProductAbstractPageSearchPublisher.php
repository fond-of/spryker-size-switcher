<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Business\Publisher;

use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface;
use FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface;

class ProductAbstractPageSearchPublisher implements ProductAbstractPageSearchPublisherInterface
{
    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeFacade;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface
     */
    protected $sizeSwitcherRepository;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface
     */
    protected $productPageSearchFacade;

    /**
     * @var \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacade;

    /**
     * @param \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToEventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \FondOfSpryker\Zed\SizeSwitcher\Dependency\Facade\SizeSwitcherToProductPageSearchFacadeInterface $productPageSearchFacade
     * @param \FondOfSpryker\Zed\SizeSwitcher\Persistence\SizeSwitcherRepositoryInterface $sizeSwitcherRepository
     */
    public function __construct(
        SizeSwitcherToStoreFacadeInterface $storeFacade,
        SizeSwitcherToEventBehaviorFacadeInterface $eventBehaviorFacade,
        SizeSwitcherToProductPageSearchFacadeInterface $productPageSearchFacade,
        SizeSwitcherRepositoryInterface $sizeSwitcherRepository
    ) {
        $this->storeFacade = $storeFacade;
        $this->sizeSwitcherRepository = $sizeSwitcherRepository;
        $this->productPageSearchFacade = $productPageSearchFacade;
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfer
     *
     * @return void
     */
    public function publish(array $eventTransfer): void
    {
        $availabiltyIds = $this->eventBehaviorFacade
            ->getEventTransferIds($eventTransfer);

        if (count($availabiltyIds) === 0) {
            return;
        }

        $productAbstractSkus = $this->queryProductAbstractSkuByAvailabilityIds($availabiltyIds);

        if (count($productAbstractSkus) === 0) {
            return;
        }

        $productAbstractIds = $this->queryProductAbstractIdsBySku($productAbstractSkus);

        if (count($productAbstractIds) === null) {
            return;
        }

        $this->productPageSearchFacade->publish($productAbstractIds);
    }

    /**
     * @param int[] $availabiltyIds
     *
     * @return string[]
     */
    protected function queryProductAbstractSkuByAvailabilityIds(array $availabiltyIds): array
    {
        $productAbstractSkus = $this->sizeSwitcherRepository->
            queryProductAbstractSkuByAvailabilityIds($availabiltyIds, $this->storeFacade->getCurrentStore()->getIdStore());

        return $productAbstractSkus;
    }

    /**
     * @param int[] $productAbstractSkus
     *
     * @return int[]
     */
    protected function queryProductAbstractIdsBySku(array $productAbstractSkus): array
    {
        $productAbstractIds = $this->sizeSwitcherRepository->queryProductAbstractIdsBySku($productAbstractSkus);

        return $productAbstractIds;
    }
}
