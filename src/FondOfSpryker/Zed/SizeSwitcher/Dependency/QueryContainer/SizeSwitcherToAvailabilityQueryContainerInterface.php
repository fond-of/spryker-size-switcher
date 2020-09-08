<?php

namespace FondOfSpryker\Zed\SizeSwitcher\Dependency\QueryContainer;

use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;

interface SizeSwitcherToAvailabilityQueryContainerInterface
{
    /**
     * @api
     *
     * @param int $idAvailabilityAbstract
     * @param int $idStore
     *
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery
     */
    public function queryAvailabilityAbstractByIdAvailabilityAbstract(int $idAvailabilityAbstract, int $idStore): SpyAvailabilityAbstractQuery;
}
