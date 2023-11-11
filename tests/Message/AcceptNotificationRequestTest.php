<?php

namespace Omnipay\Aerotow\Tests\Message;

use Omnipay\Aerotow\Message\AcceptNotificationRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Tests\TestCase;

class AcceptNotificationRequestTest extends TestCase
{
    public function testAtmGetData()
    {
        $data = [
            'Ordernum' => 'TV20180521000002',
            'ACTCode' => '8089205603291469800',
            'Total' => '100',
            'Status' => '0000',
            'BKID' => '0130000123456543210',
        ];

        $this->getHttpRequest()->request->add($data);
        $request = new AcceptNotificationRequest($this->getHttpClient(), $this->getHttpRequest());

        self::assertEquals($data, $request->getData());

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
        $data = [
            'Ordernum' => 'TV20180521000001',
            'StoreCode' => ' AB2AB15XX10004',
            'Total' => '100',
            'Status' => '0000',
            'Store' => '01',
            'StoreName' => '197582',
        ];

        $httpRequest = $this->getHttpRequest();
        $httpRequest->request->add($data);
        $request = new AcceptNotificationRequest($this->getHttpClient(), $httpRequest);

        self::assertEquals($data, $request->getData());

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

        self::assertEquals('', $notification->getTransactionReference());
        self::assertEquals(NotificationInterface::STATUS_COMPLETED, $notification->getTransactionStatus());
    }
}
