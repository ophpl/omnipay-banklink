<?php

namespace Omnipay\Banklink\Tests\Message;

use Omnipay\Banklink\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'sellerId' => 'seller-id',
            'sellerName' => 'seller name',
            'sellerAccount' => 'seller account',
            'publicKey' => '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqSI7HZt/svInL0rETCsw
T2BTE9pBlEUxQSEFmp7iyInvNQhZLOA/tESzZmtcXORvIdAPw5AdD3KHEWw72TYd
d80Psxl/upLz6dPBg/u2RX5RSdmvrO5QtHkbfLvAKoYuZtkFV7TQxxCeY7HW3hVI
0ndNeRu1X0RUw3sOt4LM5QwHBbRUwNtjehbOniqV6EWRGnmSC3ugjPhm8sLpm4DJ
3iDb5KlPOUO34DcHI33rqR4aLibyYpgqFYZyM+MGOIxmqgW3er4rmYvSq8qS9tnz
xla4ZVavIVOVb76G0FlAIkjNdJR0qmbp3ax69sDKs5EdeULcCU4WhtMfPt2asg34
UQIDAQAB
-----END PUBLIC KEY-----',
            'privateKey' => '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAqSI7HZt/svInL0rETCswT2BTE9pBlEUxQSEFmp7iyInvNQhZ
LOA/tESzZmtcXORvIdAPw5AdD3KHEWw72TYdd80Psxl/upLz6dPBg/u2RX5RSdmv
rO5QtHkbfLvAKoYuZtkFV7TQxxCeY7HW3hVI0ndNeRu1X0RUw3sOt4LM5QwHBbRU
wNtjehbOniqV6EWRGnmSC3ugjPhm8sLpm4DJ3iDb5KlPOUO34DcHI33rqR4aLiby
YpgqFYZyM+MGOIxmqgW3er4rmYvSq8qS9tnzxla4ZVavIVOVb76G0FlAIkjNdJR0
qmbp3ax69sDKs5EdeULcCU4WhtMfPt2asg34UQIDAQABAoIBAB82H+6gyXn+Udja
VUsxFSMwxWP+fOedtS8tptkXxQX43lnNBpfPcjIUE38tBMhnp1J4ENCoAZTeL6q5
bHnzEJERGHqWlAmcIMLfvvBaPRKp8tpL/61L9Ty4tKfaBeZTCLEWD3RV+8kgefov
0VT+XIfqWDOnN1szQukoBlk7HBCQUNOPXGDYHKq9+8Qzs93NF0lcboS33CtMR9Mr
qO0vb0ETDUqhaX3v9ZsQR+UVpzgA3pr282QzF+yizslwuZCMEmMg4T52B55HYxeo
WrZkGKZ277rWHa1jDAL3p2SDfQPvyizuC5s45bFuxaa/Dxs9Y+IYLHQn7M29YfeY
WgnN47kCgYEA0/VoWZkZe+7WfCEjH7f4SnQc4h3ZWB6WUqi0CDLt0eIOWrWXMbvY
OchECiOKZqMBtg615JGShE5MLujNXasGEYUPWHEoFNP9/Zz5+rnKhy3ghy3FQp01
ZEawCKehOEp5f6oiEa3Ee1qorJLrd0A8FTp6Z86khPWTr8W3/b4JK/8CgYEAzEbc
2ldfvWcKgO0PFJ3t6hiLroHBl5K9SZnJMelvL6/SBUai8NcY3T225QJfuLjj0Y/6
QRoqsCfymhMrm+j54zIEYFJKehVKvpkilv6519F+6L6JErEP+u3LbS3ddvwS6RpU
EDzC7PWl+AP4w3Z0Vhw8hm0eI5aJJZ7GqdHbG68CgYBMbiHCrUJTPjx5ZjmUJnKR
5mzD3J+S9vSdudexXSwEks86RmDOvj2qGFzwiwBNIlprm8JbOWLr8o/mGmxzakg1
6RUvfx5E5GyiFwjNMFGnjRN5qzeGXcny7sprVIb+FVzafC7s0QwYrwhDsnbV+YOw
4/VfmVQZ3bPznghKp0wHYQKBgQCvoPVdG+YKl77mHerrVOUqcbQWcyUYxmbMEtZy
fTrFCytMsfCBlM2h2d+XgbT+wqfMkzccJf0xuwbQBU9nGqVN+sDcd6Pk1s2OlWax
34u0zD+Kp9Z+JZGRskVGNzrDg/JWS/aehz8oMANj+zY0B3H6XwiCoupYuqJrn9k6
RF1XrQKBgQCmz3HN6B92EeeXT//tTeu5d3BUNlZfTsdItCtzaMv83W/dTzgglhAx
b9q+GND/G7X2v03bZcY4XQvlLKP6r3I/9vMsDSyUm+OgJ6o8F8W+ni2xdVPQ/ouS
F3rf0c9wHIVHU89py3dwJnqpAcG3/ux9WDr3mFdYw1vUTwcb8Gtp3w==
-----END RSA PRIVATE KEY-----',
            'privateKeyPassword' => '',
            'provider' => 'seb.ee',
            'amount'        => 15.34,
            'currency'      => 'EUR',
            'description'   => 'Test',
            'returnUrl'     => 'https://www.example.com/return.html',
            'cancelUrl'     => 'https://www.example.com/cancel.html'
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertNotEmpty($data['id']);
        $this->assertNotEmpty($data['url']);
        $this->assertNotEmpty($data['data']);
        $this->assertSame('1011', $data['data']['VK_SERVICE']);
        $this->assertSame('008', $data['data']['VK_VERSION']);
        $this->assertSame('seller-id', $data['data']['VK_SND_ID']);
        $this->assertSame(15.34, $data['data']['VK_AMOUNT']);
        $this->assertSame('EUR', $data['data']['VK_CURR']);
        $this->assertSame('Test', $data['data']['VK_MSG']);
        $this->assertSame('https://www.example.com/return.html', $data['data']['VK_RETURN']);
        $this->assertSame('https://www.example.com/cancel.html', $data['data']['VK_CANCEL']);
        $this->assertSame('seller name', $data['data']['VK_NAME']);
        $this->assertSame('seller account', $data['data']['VK_ACC']);
    }
}
