<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\PayoutRequest;
use Omnipay\Tests\TestCase;

class PayoutRequestTest extends TestCase
{
    public function testAtmGetData()
    {
        $options = [
            'Ordernum' => 'TV20180521000002',
            'ACID' => '8089205603291469800',
            'Total' => 100,
        ];
        $this->getHttpRequest()->request->add($options);
        $request = new PayoutRequest($this->getHttpClient(), $this->getHttpRequest());

        self::assertEquals($options, $request->getData());

        return [$request->send(), $options];
    }

    /**
     * @depends testAtmGetData
     *
     * @param  array  $results
     */
    public function testAtmSend($results)
    {
        $response = $results[0];
        $options = $results[1];

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertEquals($options['Ordernum'], $response->getTransactionId());
        self::assertEquals($options, $response->getData());
    }

    public function testCvsGetData()
    {
        $options = [
            'Ordernum' => 'TV20180521000002',
            'StoreCode' => 'AB2AB15XX10004',
            'Total' => 100,
            'mobileUrl' => 'https://aaa.bbb.com.tw/mPay?AA160824000000',
        ];
        $this->getHttpRequest()->request->add($options);
        $request = new PayoutRequest($this->getHttpClient(), $this->getHttpRequest());

        self::assertEquals($options, $request->getData());

        return [$request->send(), $options];
    }

    /**
     * @depends testCvsGetData
     *
     * @param  array  $results
     */
    public function testCvsSend($results)
    {
        $response = $results[0];
        $options = $results[1];

        self::assertFalse($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals($options['Ordernum'], $response->getTransactionId());
        self::assertEquals($options, $response->getData());
    }
}
