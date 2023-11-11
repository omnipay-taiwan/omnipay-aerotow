<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Aerotow\Traits\HasMerchant;
use Omnipay\Common\Message\AbstractRequest;

class CompletePurchaseRequest extends AbstractRequest
{
    use HasMerchant;

    /**
     * @return array
     */
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    /**
     * @param  array  $data
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
