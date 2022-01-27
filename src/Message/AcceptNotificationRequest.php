<?php

namespace Omnipay\Aerotow\Message;

class AcceptNotificationRequest extends CompletePurchaseRequest
{
    /**
     * @param array $data
     * @return AcceptNotificationResponse
     */
    public function sendData($data)
    {
        return $this->response = new AcceptNotificationResponse($this, $data);
    }
}
