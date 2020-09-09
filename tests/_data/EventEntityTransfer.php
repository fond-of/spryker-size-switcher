<?php

$jsonArray = '{"id":1612,"event":"Entity.spy_availability.update","name":"spy_availability","foreign_keys":{"spy_availability.fk_availability_abstract":1612,"spy_availability.fk_store":1}}';
$array = \json_decode($jsonArray, true);

$transfer = new \Generated\Shared\Transfer\EventEntityTransfer();
$transfer->fromArray($array);

return $transfer;
