<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Dependency\QueryContainer;

use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;

class SizeSwitcherToAvailabilityQueryContainerBridge implements SizeSwitcherToAvailabilityQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     */
    protected $availabilityQueryContainer;

    /**
     * @param \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface $availabilityQueryContainer
     */
    public function __construct($availabilityQueryContainer)
    {
        $this->availabilityQueryContainer = $availabilityQueryContainer;
    }

    /**
     * @api
     *
     * @param int $idAvailabilityAbstract
     * @param int $idStore
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery
     */
    public function queryAvailabilityAbstractByIdAvailabilityAbstract(int $idAvailabilityAbstract, int $idStore): SpyAvailabilityAbstractQuery
    {
        return $this->availabilityQueryContainer->queryAvailabilityAbstractByIdAvailabilityAbstract($idAvailabilityAbstract, $idStore);
    }
}
