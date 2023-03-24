<?php

namespace Omnipay\Aerotow\Traits;

trait HasAmount
{
    public function getAmount()
    {
        return $this->getParameter('amount');
    }
}
