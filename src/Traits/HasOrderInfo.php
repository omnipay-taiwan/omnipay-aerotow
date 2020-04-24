<?php

namespace Omnipay\Aerotow\Traits;

trait HasOrderInfo
{
    /**
     * @param string $orderNum
     * @return $this
     */
    public function setOrderNum($orderNum)
    {
        return $this->setParameter('Ordernum', $orderNum);
    }

    /**
     * @return string
     */
    public function getOrderNum()
    {
        return $this->getParameter('Ordernum');
    }

    /**
     * @param string $total
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
