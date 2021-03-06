<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Aerotow\Traits\HasAtmResponse;
use Omnipay\Aerotow\Traits\HasCvsResponse;
use Omnipay\Aerotow\Traits\HasMerchant;
use Omnipay\Aerotow\Traits\HasOrderInfo;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\NotificationInterface;

class CompletePurchaseRequest extends AbstractRequest implements NotificationInterface
{
    use HasMerchant;
    use HasOrderInfo;
    use HasAtmResponse;
    use HasCvsResponse;

    /**
     * @param string $status
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
     * @throws InvalidRequestException
     */
    public function getData()
    {
        return [
            'Ordernum' => $this->getOrderNum(),
            'ACTCode' => $this->getActCode(),
            'Total' => (int) $this->getAmount(),
            'Status' => $this->getStatus(),
        ];
    }

    /**
     * @param array $data
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    public function getTransactionStatus()
    {
        return $this->getNotification()->getTransactionStatus();
    }

    public function getMessage()
    {
        return $this->getNotification()->getMessage();
    }

    /**
     * @return NotificationInterface
     */
    protected function getNotification()
    {
        return ! $this->response ? $this->send() : $this->response;
    }
}
