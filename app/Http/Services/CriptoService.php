<?php

namespace App\Http\Services;

use App\Http\Repositories\CriptoRepository;

class CriptoService
{
    public function __construct(
        private CriptoRepository $criptoRepository,
    )
    {}

    public function getResponseApiBitcoin()
    {
        return $this->criptoRepository->getResponseApiBitcoin();
    }
    public function getResponseApiDollar()
    {
        return $this->criptoRepository->getResponseApiDollar();
    }
    public function convertDollarToReais(float $value)
    {
        return $this->criptoRepository->convertDollarToReais($value);
    }
}