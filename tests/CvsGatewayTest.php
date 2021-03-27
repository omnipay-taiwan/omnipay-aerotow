<?php

namespace Omnipay\Aerotow\Tests;

use Omnipay\Aerotow\CvsGateway;
use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Aerotow\Message\PurchaseRequest;
use Omnipay\Aerotow\Message\ReceiveTransactionInfoRequest;
use Omnipay\Tests\GatewayTestCase;

class CvsGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new CvsGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $options = ['endpoint' => 'foo.bar', 'Name' => 'foo', 'OrderID' => 'abc', 'amount' => '10.00', 'ReAUrl' => 'foo.bar', 'ReBUrl' => 'foo.bar'];
        $request = $this->gateway->purchase($options);

        self::assertInstanceOf(PurchaseRequest::class, $request);
        self::assertArrayHasKey('Total', $request->getData());
    }

    public function testCompletePurchase()
    {
        $options = ['transactionReference' => 'abc123'];
        $request = $this->gateway->completePurchase($options);

        self::assertInstanceOf(CompletePurchaseRequest::class, $request);
    }

    public function testReceiveTransaction()
    {
        $options = [];
        $request = $this->gateway->receiveTransactionInfo($options);

        self::assertInstanceOf(ReceiveTransactionInfoRequest::class, $request);
    }
}
