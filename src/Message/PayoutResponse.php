<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PayoutResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->isRedirect() === false;
    }

    /**
     * Does the response require a redirect?
     *
     * @return bool
     */
    public function isRedirect()
    {
        return array_key_exists('mobileUrl', $this->data);
    }

    /**
     * Get the transaction ID as generated by the merchant website.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->data['Ordernum'];
    }

    public function getRedirectUrl()
    {
        return $this->data['mobileUrl'];
    }

    public function getReply()
    {
        return $this->isSuccessful() ? 'OK' : 'FAIL';
    }
}
