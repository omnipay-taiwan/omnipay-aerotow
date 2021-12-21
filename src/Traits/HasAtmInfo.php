<?php

namespace Omnipay\Aerotow\Traits;

trait HasAtmInfo
{
    /**
     * @param string $acid
     * @return $this
     */
    public function setACID($acid)
    {
        return $this->setParameter('ACID', $acid);
    }

    /**
     * @return string
     */
    public function getACID()
    {
        return $this->getParameter('ACID');
    }
}
