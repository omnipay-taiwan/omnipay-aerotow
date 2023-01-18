<?php

namespace Omnipay\Aerotow\Traits;

trait HasMerchant
{
    /**
     * @param $gatewayName
     * @return $this
     */
    public function setGatewayName($gatewayName)
    {
        return $this->setParameter('gateway_name', $gatewayName);
    }

    /**
     * @return string
     */
    public function getGatewayName()
    {
        return $this->getParameter('gateway_name');
    }

    /**
     * @param  string  $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        return $this->setParameter('endpoint', $endpoint);
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    /**
     * @param  string  $merchant
     * @return $this
     */
    public function setMerchant($merchant)
    {
        return $this->setParameter('Merchant', $merchant);
    }

    /**
     * @return string
     */
    public function getMerchant()
    {
        return $this->getParameter('Merchant');
    }

    /**
     * @param  string  $merchant
     * @return $this
     */
    public function setMerchent($merchant)
    {
        return $this->setMerchant($merchant);
    }

    /**
     * @return string
     */
    public function getMerchent()
    {
        return $this->getMerchant();
    }
}
