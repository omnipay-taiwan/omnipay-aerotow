<?php

namespace Omnipay\Aerotow\Traits;

trait HasCvsInfo
{
    use HasStoreCode;

    /**
     * @param string $mobileUrl
     * @return $this
     */
    public function setMobileUrl($mobileUrl)
    {
        return $this->setParameter('MobileUrl', $mobileUrl);
    }

    /**
     * @return string
     */
    public function getMobileUrl()
    {
        return $this->getParameter('MobileUrl');
    }
}
