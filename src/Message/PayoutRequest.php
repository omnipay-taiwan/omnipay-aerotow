<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Aerotow\Traits\HasAtmInfo;
use Omnipay\Aerotow\Traits\HasCvsInfo;
use Omnipay\Aerotow\Traits\HasOrderInfo;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class PayoutRequest extends AbstractRequest
{
    use HasOrderInfo;
    use HasAtmInfo;
    use HasCvsInfo;

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
     * @param  mixed  $data
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PayoutResponse($this, $data);
    }

    /**
     * @return string
     */
    public function isAtm()
    {
        return $this->getACID();
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
            'ACID' => $this->getACID(),
            'Total' => (int) $this->getAmount(),
        ];
    }

    private function getCvsData()
    {
        return [
            'Ordernum' => $this->getOrderNum(),
            'StoreCode' => $this->getStoreCode(),
            'Total' => (int) $this->getAmount(),
            'mobileUrl' => $this->getMobileUrl(),
        ];
    }
}
