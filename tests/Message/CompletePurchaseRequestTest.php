<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Tests\TestCase;

class CompletePurchaseRequestTest extends TestCase
{
    public function testGetData()
    {
        $parameters = [
            'Ordernum' => 'TV20180521000002',
            'ACTCode' => '8089205603291469800',
            'Total' => '100',
            'Status' => '0000',
        ];

        $request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array_merge($parameters, []));

        $this->assertEquals($parameters, $request->getData());

        return [$request->send(), $parameters];
    }

    /**
     * @depends testGetData
     * @param array $results
     */
    public function testSend($results)
    {
        list($response, $parameters) = $results;

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('0000', $response->getCode());
        $this->assertEquals('TV20180521000002', $response->getTransactionId());
        $this->assertEquals($parameters, $response->getData());
    }
}
