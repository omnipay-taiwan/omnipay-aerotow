<?php

namespace Omnipay\Aerotow\Traits;

trait HasOrderInfo
{
    /**
     * @param  string  $value
     * @return $this
     */
    public function setOrderNum($value)
    {
        return $this->setTransactionId($value);
    }

    /**
     * @return string
     */
    public function getOrderNum()
    {
        return $this->getTransactionId();
    }

    /**
     * @param  string  $total
     * @return $this
     */
    public function setTotal($total)
    {
        return $this->setAmount($total);
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->getAmount();
    }
}
