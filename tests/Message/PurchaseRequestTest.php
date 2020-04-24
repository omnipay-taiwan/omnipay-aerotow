<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function testAtmGetData()
    {
        $parameters = [
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
        $request->initialize(array_merge($parameters, [
            'gateway_name' => 'Aerotow_ATM',
            'endpoint' => 'http://myhomepei.com',
        ]));

        $this->assertEquals($parameters, $request->getData());

        return [$request->send(), $parameters];
    }

    /**
     * @depends testAtmGetData
     * @param array $results
     */
    public function testAtmSend($results)
    {
        list($response, $parameters) = $results;

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('http://myhomepei.com/api/getway05/VracRequest.ashx', $response->getRedirectUrl());
        $this->assertEquals($parameters, $response->getRedirectData());
    }

    public function testCvsGetData()
    {
        $parameters = [
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
        $request->initialize(array_merge($parameters, [
            'gateway_name' => 'Aerotow_CVS',
            'endpoint' => 'http://myhomepei.com',
        ]));

        $this->assertEquals($parameters, $request->getData());

        return [$request->send(), $parameters];
    }

    /**
     * @depends testCvsGetData
     * @param array $results
     */
    public function testCvsSend($results)
    {
        list($response, $parameters) = $results;

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('POST', $response->getRedirectMethod());
        $this->assertEquals('http://myhomepei.com/api/getway01/CodeRequest.ashx', $response->getRedirectUrl());
        $this->assertEquals($parameters, $response->getRedirectData());
    }
}
