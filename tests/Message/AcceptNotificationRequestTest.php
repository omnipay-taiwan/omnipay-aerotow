<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\AcceptNotificationRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Tests\TestCase;

class AcceptNotificationRequestTest extends TestCase
{
    public function testGetData()
    {
        $options = [
            'Ordernum' => 'TV20180521000002',
            'ACTCode' => '8089205603291469800',
            'Total' => '100',
            'Status' => '0000',
        ];

        $request = new AcceptNotificationRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array_merge($options, []));

        self::assertEquals($options, $request->getData());

        return [$request];
    }

    /**
     * @depends testGetData
     * @param array $results
     */
    public function testSend($results)
    {
        list($notification) = $results;

        self::assertEquals('TV20180521000002', $notification->getTransactionId());
        self::assertEquals('', $notification->getTransactionReference());
        self::assertEquals(NotificationInterface::STATUS_COMPLETED, $notification->getTransactionStatus());
    }
}
