<?php

namespace Omnipay\Aerotow\Tests;

use Omnipay\Aerotow\AtmGateway;
use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Aerotow\Message\PurchaseRequest;
use Omnipay\Aerotow\Message\ReceiveRequest;
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

        $this->assertInstanceOf(PurchaseRequest::class, $request);
        $this->assertArrayHasKey('Total', $request->getData());
        $this->assertEquals('Aerotow_ATM', $request->getGatewayName());
    }

    public function testCompletePurchase()
    {
        $options = ['transactionReference' => 'abc123'];
        $request = $this->gateway->completePurchase($options);

        $this->assertInstanceOf(CompletePurchaseRequest::class, $request);
    }

    public function testReceiveTransaction()
    {
        $options = [];
        $request = $this->gateway->receive($options);

        $this->assertInstanceOf(ReceiveRequest::class, $request);
    }
}
