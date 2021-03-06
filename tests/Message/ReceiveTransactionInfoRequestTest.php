<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\ReceiveTransactionInfoRequest;
use Omnipay\Tests\TestCase;

class ReceiveTransactionInfoRequestTest extends TestCase
{
    public function testAtmGetData()
    {
        $options = [
            'Ordernum' => 'TV20180521000002',
            'ACID' => '8089205603291469800',
            'Total' => 100,
        ];
        $request = new ReceiveTransactionInfoRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($options);

        self::assertEquals($options, $request->getData());

        return [$request->send(), $options];
    }

    /**
     * @depends testAtmGetData
     * @param array $results
     */
    public function testAtmSend($results)
    {
        list($response, $options) = $results;

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
        $request = new ReceiveTransactionInfoRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($options);

        self::assertEquals($options, $request->getData());

        return [$request->send(), $options];
    }

    /**
     * @depends testCvsGetData
     * @param array $results
     */
    public function testCvsSend($results)
    {
        list($response, $options) = $results;

        self::assertFalse($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals($options['Ordernum'], $response->getTransactionId());
        self::assertEquals($options, $response->getData());
    }
}
