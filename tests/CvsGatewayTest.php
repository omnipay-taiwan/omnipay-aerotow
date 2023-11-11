<?php

namespace Omnipay\Aerotow\Tests;

use Omnipay\Aerotow\CvsGateway;
use Omnipay\Aerotow\Message\CompletePurchaseRequest;
use Omnipay\Aerotow\Message\PayoutRequest;
use Omnipay\Aerotow\Message\PurchaseRequest;
use Omnipay\Tests\GatewayTestCase;

class CvsGatewayTest extends GatewayTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new CvsGateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $options = [
            'endpoint' => 'foo.bar', 'Name' => 'foo', 'OrderID' => 'abc', 'amount' => '10.00', 'ReAUrl' => 'foo.bar',
            'ReBUrl' => 'foo.bar',
        ];
        $request = $this->gateway->purchase($options);

        self::assertInstanceOf(PurchaseRequest::class, $request);
        self::assertArrayHasKey('Total', $request->getData());
    }

    public function testCompletePurchase()
    {
        $options = ['transactionReference' => 'abc123'];
        $this->getHttpRequest()->request->add($options);
        $request = $this->gateway->completePurchase();

        self::assertInstanceOf(CompletePurchaseRequest::class, $request);
    }

    public function testPayout()
    {
        $request = $this->gateway->payout();

        self::assertInstanceOf(PayoutRequest::class, $request);
    }
}
