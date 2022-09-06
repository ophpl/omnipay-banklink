<?php

namespace Omnipay\Banklink\Tests;

use Omnipay\Banklink\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    public $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setSellerId('seller-id');
        $this->gateway->setSellerName('seller name');
        $this->gateway->setSellerAccount('seller account');
        $this->gateway->setPublicKey('public key');
        $this->gateway->setPrivateKey('private key');
        $this->gateway->setPrivateKeyPassword('private key pass');
        $this->gateway->setProvider('provider');
        $this->gateway->setTestMode(true);
    }

    public function testGateway()
    {
        $this->assertSame('seller-id', $this->gateway->getSellerId());
        $this->assertSame('seller name', $this->gateway->getSellerName());
        $this->assertSame('seller account', $this->gateway->getSellerAccount());
        $this->assertSame('public key', $this->gateway->getPublicKey());
        $this->assertSame('private key', $this->gateway->getPrivateKey());
        $this->assertSame('private key pass', $this->gateway->getPrivateKeyPassword());
        $this->assertSame('provider', $this->gateway->getProvider());
        $this->assertTrue($this->gateway->getTestMode());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase();
        $this->assertInstanceOf('Omnipay\Banklink\Message\PurchaseRequest', $request);
    }
}
