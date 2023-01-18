<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Tests\TestCase;

class CompletePurchaseRequestTest extends TestCase
{
    public function testAtmGetData()
    {
        $options = [
            'Ordernum' => 'TV20180521000002',
            'ACTCode' => '8089205603291469800',
            'Total' => '100',
            'Status' => '0000',
            'BKID' => '0130000123456543210',
        ];

        $request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($options);

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
        self::assertEquals('0000', $response->getCode());
        self::assertEquals('TV20180521000002', $response->getTransactionId());
        self::assertEquals($options, $response->getData());
    }

    public function testCvsGetData()
    {
        $options = [
            'Ordernum' => 'TV20180521000001',
            'StoreCode' => ' AB2AB15XX10004',
            'Total' => '100',
            'Status' => '0000',
            'Store' => '01',
            'StoreName' => '197582',
        ];

        $request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($options);

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

        self::assertTrue($response->isSuccessful());
        self::assertEquals('0000', $response->getCode());
        self::assertEquals('TV20180521000001', $response->getTransactionId());
        self::assertEquals($options, $response->getData());
    }
}
