<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Aerotow\Traits\HasAmount;
use Omnipay\Aerotow\Traits\HasAtmResponse;
use Omnipay\Aerotow\Traits\HasCvsResponse;
use Omnipay\Aerotow\Traits\HasMerchant;
use Omnipay\Aerotow\Traits\HasOrderInfo;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;

class CompletePurchaseRequest extends AbstractRequest
{
    use HasMerchant;
    use HasOrderInfo;
    use HasAtmResponse;
    use HasCvsResponse;
    use HasAmount;

    /**
     * @param  string  $status
     * @return CompletePurchaseRequest
     */
    public function setStatus($status)
    {
        return $this->setParameter('Status', $status);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getParameter('Status');
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
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    /**
     * @return array
     *
     * @throws InvalidRequestException
     */
    private function getAtmData()
    {
        return [
            'Ordernum' => $this->getOrderNum(),
            'ACTCode' => $this->getActCode(),
            'Total' => $this->getAmount(),
            'Status' => $this->getStatus(),
            'BKID' => $this->getBKID(),
        ];
    }

    /**
     * @return array
     *
     * @throws InvalidRequestException
     */
    private function getCvsData()
    {
        return [
            'Ordernum' => $this->getOrderNum(),
            'StoreCode' => $this->getStoreCode(),
            'Total' => $this->getAmount(),
            'Status' => $this->getStatus(),
            'Store' => $this->getStore(),
            'StoreName' => $this->getStoreName(),
        ];
    }

    /**
     * @return bool
     */
    private function isAtm()
    {
        return ! empty($this->getActCode());
    }
}
