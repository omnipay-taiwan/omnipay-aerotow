<?php

namespace Omnipay\Aerotow\Tests;

use Omnipay\Aerotow\AtmGateway;
use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Aerotow\Message\PurchaseRequest;
use Omnipay\Aerotow\Message\ReceiveTransactionInfoRequest;
use Omnipay\Tests\GatewayTestCase;

class AtmGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new AtmGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $options = ['endpoint' => 'foo.bar', 'OrderID' => 'abc', 'amount' => '10.00', 'ReAUrl' => 'foo.bar', 'ReBUrl' => 'foo.bar'];
        $request = $this->gateway->purchase($options);

        self::assertInstanceOf(PurchaseRequest::class, $request);
        self::assertArrayHasKey('Total', $request->getData());
        self::assertEquals('Aerotow_ATM', $request->getGatewayName());
    }

    public function testCompletePurchase()
    {
        $options = ['transactionReference' => 'abc123'];
        $request = $this->gateway->completePurchase($options);

        self::assertInstanceOf(CompletePurchaseRequest::class, $request);
    }

    public function testReceiveTransactionInfo()
    {
        $options = ['ACID' => 'ACID'];
        $request = $this->gateway->completePurchase($options);

        self::assertInstanceOf(ReceiveTransactionInfoRequest::class, $request);
    }
}
