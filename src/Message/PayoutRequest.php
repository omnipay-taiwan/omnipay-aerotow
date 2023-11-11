<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Aerotow\Traits\HasOrderInfo;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class PayoutRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    /**
     * @param  array  $data
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PayoutResponse($this, $data);
    }
}
