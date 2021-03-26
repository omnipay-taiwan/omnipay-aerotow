<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Tests\TestCase;

class CompletePurchaseRequestTest extends TestCase
{
    public function testGetData()
    {
        $options = [
            'Ordernum' => 'TV20180521000002',
            'ACTCode' => '8089205603291469800',
            'Total' => '100',
            'Status' => '0000',
        ];

        $request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array_merge($options, []));

        self::assertEquals($options, $request->getData());

        return [$request->send(), $options];
    }

    /**
     * @depends testGetData
     * @param array $results
     */
    public function testSend($results)
    {
        list($response, $options) = $results;

        self::assertTrue($response->isSuccessful());
        self::assertEquals('0000', $response->getCode());
        self::assertEquals('TV20180521000002', $response->getTransactionId());
        self::assertEquals($options, $response->getData());
    }
}
