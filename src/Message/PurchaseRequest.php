<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Aerotow\Traits\HasAmount;
use Omnipay\Aerotow\Traits\HasMerchant;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    use HasMerchant;
    use HasAmount;

    /**
     * @param  string  $value
     * @return PurchaseRequest
     */
    public function setOrderID($value)
    {
        return $this->setTransactionId($value);
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
        return $this->getTransactionId();
    }

    /**
     * @param  string  $value
     * @return PurchaseRequest
     */
    public function setTotal($value)
    {
        return $this->setAmount($value);
    }

    /**
     * @return int
     *
     * @throws InvalidRequestException
     */
    public function getTotal()
    {
        return $this->getAmount();
    }

    /**
     * @param  string  $value
     * @return PurchaseRequest
     */
    public function setProduct($value)
    {
        return $this->setParameter('Product', $value);
    }

    /**
     * @return string
     */
    public function getProduct()
    {
        return $this->getParameter('Product');
    }

    /**
     * @param  string  $value
     * @return PurchaseRequest
     */
    public function setName($value)
    {
        return $this->setParameter('Name', $value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getParameter('Name');
    }

    /**
     * @param  int  $value
     * @return PurchaseRequest
     */
    public function setHour($value)
    {
        return $this->setParameter('Hour', $value);
    }

    /**
     * @return int
     */
    public function getHour()
    {
        return $this->getParameter('Hour');
    }

    /**
     * @param  string  $value
     * @return PurchaseRequest
     */
    public function setMSG($value)
    {
        return $this->setDescription($value);
    }

    /**
     * @return string
     */
    public function getMSG()
    {
        return $this->getDescription();
    }

    /**
     * @param  string  $value
     * @return PurchaseRequest
     */
    public function setReAUrl($value)
    {
        return $this->setReturnUrl($value);
    }

    /**
     * @return string
     */
    public function getReAUrl()
    {
        return $this->getReturnUrl();
    }

    /**
     * @param  string  $value
     * @return PurchaseRequest
     */
    public function setReBUrl($value)
    {
        return $this->setNotifyUrl($value);
    }

    /**
     * @return string
     */
    public function getReBUrl()
    {
        return $this->getNotifyUrl();
    }

    /**
     * @return array
     *
     * @throws InvalidRequestException
     */
    public function getData()
    {
        return $this->isAtm() ? $this->getAtmData() : $this->getCvsData();
    }

    /**
     * @param  array  $data
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    /**
     * @return bool
     */
    public function isAtm()
    {
        return $this->getGatewayName() === 'Aerotow_ATM';
    }

    /**
     * @return array
     *
     * @throws InvalidRequestException
     */
    private function getAtmData()
    {
        $this->validate('endpoint', 'Merchant', 'transactionId', 'amount', 'notifyUrl', 'returnUrl');

        return [
            'Merchent' => $this->getMerchant(),
            'OrderID' => $this->getTransactionId(),
            'Total' => $this->getAmount(),
            'Product' => $this->getProduct(),
            'Name' => $this->getName(),
            'MSG' => $this->getDescription(),
            'ReAUrl' => $this->getReturnUrl(),
            'ReBUrl' => $this->getNotifyUrl(),
        ];
    }

    /**
     * @return array
     *
     * @throws InvalidRequestException
     */
    private function getCvsData()
    {
        $this->validate('endpoint', 'Merchant', 'Name', 'transactionId', 'amount', 'notifyUrl', 'returnUrl');

        return array_merge($this->getAtmData(), [
            'Hour' => $this->getHour(),
        ]);
    }
}
