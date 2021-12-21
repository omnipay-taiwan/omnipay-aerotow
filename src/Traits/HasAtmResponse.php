<?php

namespace Omnipay\Aerotow\Traits;

trait HasAtmResponse
{
    /**
     * Response Data.
     *
     * @param string $actCode
     * @return $this
     */
    public function setActCode($actCode)
    {
        return $this->setParameter('ACTCode', $actCode);
    }

    /**
     * @return string
     */
    public function getActCode()
    {
        return $this->getParameter('ACTCode');
    }

    /**
     * Response Data.
     *
     * @param string $BKID
     * @return $this
     */
    public function setBKID($BKID)
    {
        return $this->setParameter('BKID', $BKID);
    }

    /**
     * @return string
     */
    public function getBKID()
    {
        return $this->getParameter('BKID');
    }
}
