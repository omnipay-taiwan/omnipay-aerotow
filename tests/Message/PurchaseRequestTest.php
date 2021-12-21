<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function testAtmGetData()
    {
        $options = [
            'Merchent' => 'TV',
            'OrderID' => 'TV20180521000002',
            'Product' => '享樂卡',
            'Total' => 200,
            'Name' => '張三豐',
            'MSG' => '備註事項',
            'ReAUrl' => 'http://localhost/receive.php',
            'ReBUrl' => 'http://localhost/return.php',
        ];
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array_merge($options, [
            'gateway_name' => 'Aerotow_ATM',
            'endpoint' => 'http://foo.bar',
        ]));

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

        self::assertFalse($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals('POST', $response->getRedirectMethod());
        self::assertEquals('http://foo.bar/api/getway05/VracRequest.ashx', $response->getRedirectUrl());
        self::assertEquals($options, $response->getRedirectData());
    }

    public function testCvsGetData()
    {
        $options = [
            'Merchent' => 'TV',
            'OrderID' => 'TV20180521000002',
            'Product' => '享樂卡',
            'Total' => 200,
            'Name' => '張三豐',
            'Hour' => 48,
            'MSG' => '備註事項',
            'ReAUrl' => 'http://localhost/receive.php',
            'ReBUrl' => 'http://localhost/return.php',
        ];
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array_merge($options, [
            'gateway_name' => 'Aerotow_CVS',
            'endpoint' => 'http://foo.bar',
        ]));

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
        self::assertEquals('POST', $response->getRedirectMethod());
        self::assertEquals('http://foo.bar/api/getway01/CodeRequest.ashx', $response->getRedirectUrl());
        self::assertEquals($options, $response->getRedirectData());
    }
}
