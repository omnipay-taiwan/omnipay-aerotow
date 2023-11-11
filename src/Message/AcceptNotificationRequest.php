<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Common\Message\NotificationInterface;

class AcceptNotificationRequest extends CompletePurchaseRequest implements NotificationInterface
{
    /**
     * @param  array  $data
     * @return AcceptNotificationResponse
     */
    public function sendData($data)
    {
        return $this->response = new AcceptNotificationResponse($this, $data);
    }

    public function getTransactionId()
    {
        return $this->getNotificationResponse()->getTransactionId();
    }

    public function getTransactionReference()
    {
        return $this->getNotificationResponse()->getTransactionReference();
    }

    public function getTransactionStatus()
    {
        return $this->getNotificationResponse()->getTransactionStatus();
    }

    public function getMessage()
    {
        return $this->getNotificationResponse()->getMessage();
    }

    /**
     * @return AcceptNotificationResponse
     */
    protected function getNotificationResponse()
    {
        return ! $this->response ? $this->send() : $this->response;
    }
}
