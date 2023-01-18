<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\AcceptNotificationRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Tests\TestCase;

class AcceptNotificationRequestTest extends TestCase
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

        $request = new AcceptNotificationRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($options);

        self::assertEquals($options, $request->getData());

        return [$request];
    }

    /**
     * @depends testAtmGetData
     *
     * @param  array  $results
     */
    public function testAtmSend($results)
    {
        $notification = $results[0];

        self::assertEquals('TV20180521000002', $notification->getTransactionId());
        self::assertEquals('', $notification->getTransactionReference());
        self::assertEquals(NotificationInterface::STATUS_COMPLETED, $notification->getTransactionStatus());
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

        $request = new AcceptNotificationRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($options);

        self::assertEquals($options, $request->getData());

        return [$request];
    }

    /**
     * @depends testCvsGetData
     *
     * @param  array  $results
     */
    public function testCvsSend($results)
    {
        $notification = $results[0];

        self::assertEquals('TV20180521000001', $notification->getTransactionId());
        self::assertEquals('', $notification->getTransactionReference());
        self::assertEquals(NotificationInterface::STATUS_COMPLETED, $notification->getTransactionStatus());
    }
}
