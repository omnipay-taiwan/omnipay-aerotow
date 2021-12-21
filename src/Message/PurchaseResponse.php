<?php

namespace Omnipay\Aerotow\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Does the response require a redirect?
     *
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * Gets the redirect target url.
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        $request = $this->getRequest();
        $endpoint = $request->getEndpoint();
        $endpoint = preg_match('/^http/', $endpoint)
            ? $endpoint : 'https://'.$endpoint;

        $path = $request->isAtm() ? 'api/getway05/VracRequest.ashx' : 'api/getway01/CodeRequest.ashx';

        return sprintf('%s/%s', rtrim($endpoint, '/'), $path);
    }

    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     *
     * @return array
     */
    public function getRedirectData()
    {
        return $this->getData();
    }
}
