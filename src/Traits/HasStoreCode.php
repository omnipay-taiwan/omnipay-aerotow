<?php

namespace Omnipay\Aerotow\Traits;

trait HasStoreCode
{
    /**
     * @param  string  $storeCode
     * @return $this
     */
    public function setStoreCode($storeCode)
    {
        return $this->setParameter('StoreCode', $storeCode);
    }

    /**
     * @return string
     */
    public function getStoreCode()
    {
        return $this->getParameter('StoreCode');
    }
}
