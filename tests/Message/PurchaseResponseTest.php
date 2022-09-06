<?php

namespace Omnipay\Banklink\Tests\Message;

use Omnipay\Banklink\Message\PurchaseRequest;
use Omnipay\Banklink\Message\PurchaseResponse;
use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testRedirect()
    {
        $response = new PurchaseResponse(
            $this->request,
            array(
                'id' => '711096929928330',
                'url' => 'https://www.seb.ee/cgi-bin/unet3.sh/ipank.r',
                'data' => array(
                    'VK_SERVICE' => '1011',
                    'VK_VERSION' => '008',
                    'VK_SND_ID' => 'seller-id',
                    'VK_STAMP' => 711096929928330,
                    'VK_AMOUNT' => 15.34,
                    'VK_CURR' => 'EUR',
                    'VK_REF' => '7110969299283303',
                    'VK_MSG' => 'Test',
                    'VK_RETURN' => 'https://www.example.com/return.html',
                    'VK_CANCEL' => 'https://www.example.com/cancel.html',
                    'VK_DATETIME' => '2022-01-01T00:00:00+0300',
                    'VK_LANG' => 'ENG',
                    'VK_NAME' => 'seller name',
                    'VK_ACC' => 'seller account',
                    'VK_MAC' => 'generated mac',
                    'VK_ENCODING' => 'UTF-8'
                )
            )
        );

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame('711096929928330', $response->getTransactionReference());
        $this->assertSame('https://www.seb.ee/cgi-bin/unet3.sh/ipank.r', $response->getRedirectUrl());
        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertNotEmpty($response->getRedirectData());
    }
}
