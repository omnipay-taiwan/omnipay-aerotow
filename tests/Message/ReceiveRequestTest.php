<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\ReceiveRequest;
use Omnipay\Tests\TestCase;

class ReceiveRequestTest extends TestCase
{
    public function testAtmGetData()
    {
        $parameters = [
            'Ordernum' => 'TV20180521000002',
            'ACID' => '8089205603291469800',
            'Total' => 100,
        ];
        $request = new ReceiveRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($parameters);

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

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($parameters['Ordernum'], $response->getTransactionId());
        $this->assertEquals($parameters, $response->getData());
    }

    public function testCvsGetData()
    {
        $parameters = [
            'Ordernum' => 'TV20180521000002',
            'StoreCode' => 'AB2AB15XX10004',
            'Total' => 100,
            'mobileUrl' => 'https://aaa.bbb.com.tw/mPay?AA160824000000',
        ];
        $request = new ReceiveRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($parameters);

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

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($parameters['Ordernum'], $response->getTransactionId());
        $this->assertEquals($parameters, $response->getData());
    }
}
