<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Aerotow\Traits\HasMerchant;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    use HasMerchant;

    /**
     * @param string $orderId
     * @return PurchaseRequest
     */
    public function setOrderID($orderId)
    {
        return $this->setTransactionId($orderId);
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
        return $this->getTransactionId();
    }

    /**
     * @param string $total
     * @return PurchaseRequest
     */
    public function setTotal($total)
    {
        return $this->setAmount($total);
    }

    /**
     * @return int
     * @throws InvalidRequestException
     */
    public function getTotal()
    {
        return (int) $this->getAmount();
    }

    /**
     * @param string $product
     * @return PurchaseRequest
     */
    public function setProduct($product)
    {
        return $this->setParameter('Product', $product);
    }

    /**
     * @return string
     */
    public function getProduct()
    {
        return $this->getParameter('Product');
    }

    /**
     * @param string $name
     * @return PurchaseRequest
     */
    public function setName($name)
    {
        return $this->setParameter('Name', $name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getParameter('Name');
    }

    /**
     * @param int $hour
     * @return PurchaseRequest
     */
    public function setHour($hour)
    {
        return $this->setParameter('Hour', $hour);
    }

    /**
     * @return int
     */
    public function getHour()
    {
        return $this->getParameter('Hour');
    }

    /**
     * @param string $msg
     * @return PurchaseRequest
     */
    public function setMSG($msg)
    {
        return $this->setDescription($msg);
    }

    /**
     * @return string
     */
    public function getMSG()
    {
        return $this->getDescription();
    }

    /**
     * @param string $reAUrl
     * @return PurchaseRequest
     */
    public function setReAUrl($reAUrl)
    {
        return $this->setReceiveUrl($reAUrl);
    }

    /**
     * @return string
     */
    public function getReAUrl()
    {
        return $this->getReceiveUrl();
    }

    /**
     * @param string $returnUrl
     * @return PurchaseRequest
     */
    public function setReBUrl($returnUrl)
    {
        return $this->setReturnUrl($returnUrl);
    }

    /**
     * @return string
     */
    public function getReBUrl()
    {
        return $this->getReturnUrl();
    }

    /**
     * @param string $receiveUrl
     * @return PurchaseRequest
     */
    public function setReceiveUrl($receiveUrl)
    {
        return $this->setParameter('ReAUrl', $receiveUrl);
    }

    /**
     * @return string
     */
    public function getReceiveUrl()
    {
        return $this->getParameter('ReAUrl');
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        return $this->isAtm() ? $this->getAtmData() : $this->getCvsData();
    }

    /**
     * @param array $data
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    private function getAtmData()
    {
        $this->validate('endpoint', 'Merchant', 'transactionId', 'amount', 'ReAUrl', 'returnUrl');

        return [
            'Merchent' => $this->getMerchant(),
            'OrderID' => $this->getTransactionId(),
            'Total' => (int) $this->getAmount(),
            'Product' => $this->getProduct(),
            'Name' => $this->getName(),
            'MSG' => $this->getDescription(),
            'ReAUrl' => $this->getReceiveUrl(),
            'ReBUrl' => $this->getReturnUrl(),
        ];
    }

    private function getCvsData()
    {
        $this->validate('endpoint', 'Merchant', 'Name', 'transactionId', 'amount', 'ReAUrl', 'returnUrl');

        return array_merge($this->getAtmData(), [
            'Hour' => $this->getHour(),
        ]);
    }
}
