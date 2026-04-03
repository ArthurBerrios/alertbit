<?php

namespace App;

interface CriptoInterfaceRepository
{
    public function getResponseApiBitcoin();
    public function getResponseApiDollar();
    public function convertDollarToReais(float $value);
}
