<?php

namespace Omnipay\Aerotow\Traits;

trait HasCvsResponse
{
    use HasStoreCode;

    /**
     * @param  string  $store
     * @return $this
     */
    public function setStore($store)
    {
        return $this->setParameter('Store', $store);
    }

    /**
     * @return string
     */
    public function getStore()
    {
        return $this->getParameter('Store');
    }

    /**
     * @param  string  $storeName
     * @return $this
     */
    public function setStoreName($storeName)
    {
        return $this->setParameter('StoreName', $storeName);
    }

    /**
     * @return string
     */
    public function getStoreName()
    {
        return $this->getParameter('StoreName');
    }
}
