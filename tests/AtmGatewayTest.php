<?php

namespace Omnipay\Aerotow\Tests;

use Omnipay\Aerotow\AtmGateway;
use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Aerotow\Message\PurchaseRequest;
use Omnipay\Aerotow\Message\GetPaymentInfoRequest;
use Omnipay\Tests\GatewayTestCase;

class AtmGatewayTest extends GatewayTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new AtmGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $options = [
            'endpoint' => 'foo.bar', 'OrderID' => 'abc', 'amount' => '10.00', 'ReAUrl' => 'foo.bar',
            'ReBUrl' => 'foo.bar',
        ];
        $request = $this->gateway->purchase($options);

        self::assertInstanceOf(PurchaseRequest::class, $request);
        self::assertArrayHasKey('Total', $request->getData());
        self::assertEquals('Aerotow_ATM', $request->getGatewayName());
    }

    public function testCompletePurchase()
    {
        $options = ['transactionReference' => 'abc123'];
        $this->getHttpRequest()->request->add($options);
        $request = $this->gateway->completePurchase();

        self::assertInstanceOf(CompletePurchaseRequest::class, $request);
    }

    public function testGetPaymentInfo()
    {
        $options = ['ACID' => 'ACID'];
        $request = $this->gateway->getPaymentInfo($options);

        self::assertInstanceOf(GetPaymentInfoRequest::class, $request);
    }
}
